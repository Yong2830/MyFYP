<?php

namespace App\Http\Controllers\admin;

use App\Models\Tenant;
use App\Models\Advertiser;
use Illuminate\Http\Request;
use App\Models\RejectedTenant;
use App\Models\PropertyListing;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\DeactivatedTenant;
use App\Models\RejectedAdvertiser;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use App\Models\DeactivatedAdvertiser;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;


class AdminReportController extends Controller
{
    public function viewUserAccManagementReport()
    {

        $tenant = Tenant::all();
        $advertiser = Advertiser::all();

        $tenantCount = $tenant->count();
        $advertiserCount = $advertiser->count();
        $userStatus = 'All';
        $userType = 'All';

        $activeTenantCount = $tenant->where('tenant_status', 'Activated')->count();
        $deactivatedTenantCount = $tenant->where('tenant_status', 'Deactivated')->count();

        $activeAdvertiserCount = $advertiser->where('advertiser_status', 'Activated')->count();
        $deactivatedAdvertiserCount = $advertiser->where('advertiser_status', 'Deactivated')->count();

        $totalRecordCount = $tenantCount + $advertiserCount;
        $totalActiveUserCount = $activeTenantCount + $activeAdvertiserCount;
        $totalDeactivatedUserCount = $deactivatedTenantCount + $deactivatedAdvertiserCount;

        $users = new Collection();
        $users = $users->concat($tenant)->concat($advertiser);

        $fromDate = null; // Set a default value
        $toDate = null; // Set a default value

        $perPage = 5;
        $currentPage = Paginator::resolveCurrentPage('page');

        // Paginate the merged collection
        $paginatedUsers = new LengthAwarePaginator(
            $users->forPage($currentPage, $perPage),
            $users->count(),
            $perPage,
            $currentPage,
            [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => 'page',
            ]
        );

        return view('administrator.reportGen.userAccReport', [
            'tenant' => $tenant,
            'advertiser' => $advertiser,
            'tenantCount' => $tenantCount,
            'advertiserCount' => $advertiserCount,
            'activeTenantCount' => $activeTenantCount,
            'deactivatedTenantCount' => $deactivatedTenantCount,
            'activeAdvertiserCount' => $activeAdvertiserCount,
            'deactivatedAdvertiserCount' => $deactivatedAdvertiserCount,
            'totalRecordCount' => $totalRecordCount,
            'totalActiveUserCount' => $totalActiveUserCount,
            'totalDeactivatedUserCount' => $totalDeactivatedUserCount,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
            'users' => $paginatedUsers,
            'userStatus' => $userStatus,
            'userType' => $userType
        ]);
    }

    public function generateUserAccManagementReport(Request $request)
    {
        $administratorId = auth()->guard('administrator')->user()->administrator_id;

        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        $userType = $request->input('user_type');
        $userStatus = $request->input('user_status');


        $tenant = Tenant::whereBetween('registration_date', [$fromDate, $toDate])->get();
        $advertiser = Advertiser::whereBetween('registration_date', [$fromDate, $toDate])->get();

        $users = new Collection();

        if ($userType == 'All') {

            if ($userStatus != 'All' && $userStatus == 'Activated') {

                $tenant = $tenant->where('tenant_status', $userStatus);
                $advertiser = $advertiser->where('advertiser_status', $userStatus);
                $users = $users->concat($tenant)->concat($advertiser);
            } else if ($userStatus != 'All' && $userStatus == 'Deactivated') {
                $tenant = $tenant->where('tenant_status', $userStatus);
                $advertiser = $advertiser->where('advertiser_status', $userStatus);
                $users = $users->concat($tenant)->concat($advertiser);
            } else {
                $users = $users->concat($tenant)->concat($advertiser);
            }
        } elseif ($userType == 'Tenant') {
            if ($userStatus != 'All' && $userStatus == 'Activated') {
                $tenant = $tenant->where('tenant_status', $userStatus);
                $users = $users->concat($tenant);
            } else if ($userStatus != 'All' && $userStatus == 'Deactivated') {
                $tenant = $tenant->where('tenant_status', $userStatus);
                $users = $users->concat($tenant);
            } else if ($userStatus != 'All' && $userStatus == 'Pending') {
                $tenant = $tenant->where('tenant_status', $userStatus);
                $users = $users->concat($tenant);
            } else {
                $users = $users->concat($tenant);
            }
        } elseif ($userType == "Advertiser") {
            if ($userStatus != 'All' && $userStatus == 'Activated') {
                $advertiser = $advertiser->where('advertiser_status', $userStatus);
                $users = $users->concat($advertiser);
            } else if ($userStatus != 'All' && $userStatus == 'Deactivated') {
                $advertiser = $advertiser->where('advertiser_status', $userStatus);
                $users = $users->concat($advertiser);
            } else if ($userStatus != 'All' && $userStatus == 'Pending') {
                $advertiser = $advertiser->where('advertiser_status', $userStatus);
                $users = $users->concat($advertiser);
            } else {
                $users = $users->concat($advertiser);
            }
        }


        $tenantCount = ($userType == 'All' || $userType == 'Tenant') ? $tenant->count() : 0;
        $advertiserCount = ($userType == 'All' || $userType == 'Advertiser') ? $advertiser->count() : 0;

        $activeTenantCount = ($userType == 'All' || $userType == 'Tenant') ? $tenant->where('tenant_status', 'Activated')->count() : 0;
        $deactivatedTenantCount = ($userType == 'All' || $userType == 'Tenant') ? $tenant->where('tenant_status', 'Deactivated')->count() : 0;

        $activeAdvertiserCount = ($userType == 'All' || $userType == 'Advertiser') ? $advertiser->where('advertiser_status', 'Activated')->count() : 0;
        $deactivatedAdvertiserCount = ($userType == 'All' || $userType == 'Advertiser') ? $advertiser->where('advertiser_status', 'Deactivated')->count() : 0;

        $totalRecordCount = $tenantCount + $advertiserCount;
        $totalActiveUserCount = $activeTenantCount + $activeAdvertiserCount;
        $totalDeactivatedUserCount = $deactivatedTenantCount + $deactivatedAdvertiserCount;

        $perPage = 5;
        $currentPage = Paginator::resolveCurrentPage('page');

        // Paginate the merged collection
        $paginatedUsers = new LengthAwarePaginator(
            $users->forPage($currentPage, $perPage),
            $users->count(),
            $perPage,
            $currentPage,
            [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => 'page',
            ]
        );

        if ($request->has('download')) {
            $pdf = Pdf::loadView('administrator.reportGen.userAccReportPNG', [
                'tenant' => $tenant,
                'advertiser' => $advertiser,
                'tenantCount' => $tenantCount,
                'advertiserCount' => $advertiserCount,
                'activeTenantCount' => $activeTenantCount,
                'deactivatedTenantCount' => $deactivatedTenantCount,
                'activeAdvertiserCount' => $activeAdvertiserCount,
                'deactivatedAdvertiserCount' => $deactivatedAdvertiserCount,
                'totalRecordCount' => $totalRecordCount,
                'totalActiveUserCount' => $totalActiveUserCount,
                'totalDeactivatedUserCount' => $totalDeactivatedUserCount,
                'fromDate' => $fromDate,
                'toDate' => $toDate,
                'users' => $users,
                'userStatus' => $userStatus,
                'userType' => $userType


            ])->setPaper('a4', 'landscape');;

            return $pdf->download('user_acc_report.pdf');
        }

        return view('administrator.reportgen.userAccReport', [
            'tenant' => $tenant,
            'advertiser' => $advertiser,
            'tenantCount' => $tenantCount,
            'advertiserCount' => $advertiserCount,
            'activeTenantCount' => $activeTenantCount,
            'deactivatedTenantCount' => $deactivatedTenantCount,
            'activeAdvertiserCount' => $activeAdvertiserCount,
            'deactivatedAdvertiserCount' => $deactivatedAdvertiserCount,
            'totalRecordCount' => $totalRecordCount,
            'totalActiveUserCount' => $totalActiveUserCount,
            'totalDeactivatedUserCount' => $totalDeactivatedUserCount,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
            'users' => $paginatedUsers,
            'userStatus' => $userStatus,
            'userType' => $userType
        ]);
    }


    public function viewPropRegManagementReport(Request $request)
    {
        $property = PropertyListing::all();

        $propertyCount = $property->count();
        $propertyType = $request->input('property_posting_status');

        $pendingPropertyCount = $property->where('property_posting_status', 'Pending')->count();
        $successPropertyCount = $property->where('property_posting_status', 'Success')->count();
        $rejectedPropertyCount = $property->where('property_posting_status', 'Rejected')->count();

        $fromDate = null; // Set a default value
        $toDate = null; // Set a default value

        $perPage = 5;
        $currentPage = Paginator::resolveCurrentPage('page');

        // Paginate the merged collection
        $paginatedUsers = new LengthAwarePaginator(
            $property->forPage($currentPage, $perPage),
            $property->count(),
            $perPage,
            $currentPage,
            [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => 'page',
            ]
        );

        return view('administrator.reportGen.propRegManagementReport', [
            'property' => $paginatedUsers,
            'propertyCount' => $propertyCount,
            'pendingPropertyCount' => $pendingPropertyCount,
            'successPropertyCount' => $successPropertyCount,
            'rejectedPropertyCount' => $rejectedPropertyCount,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
            'propertyType' => $propertyType,
        ]);
    }

    public function generatePropRegManagementReport(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        $propertyType = $request->input('property_posting_status');

        $propertyQuery = PropertyListing::query();

        if ($propertyType !== 'All') {
            $propertyQuery->where('property_posting_status', $propertyType);
        }

        $property = $propertyQuery->whereBetween('property_post_date', [$fromDate, $toDate])->get();

        $propertyCount = $property->count();
        $pendingPropertyCount = $property->where('property_posting_status', 'Pending')->count();
        $successPropertyCount = $property->where('property_posting_status', 'Success')->count();
        $rejectedPropertyCount = $property->where('property_posting_status', 'Rejected')->count();

        $perPage = 5;
        $currentPage = Paginator::resolveCurrentPage('page');

        // Paginate the merged collection
        $paginatedUsers = new LengthAwarePaginator(
            $property->forPage($currentPage, $perPage),
            $property->count(),
            $perPage,
            $currentPage,
            [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => 'page',
            ]
        );

        if ($request->has('download')) {
            $pdf = Pdf::loadView('administrator.reportGen.propResReportPNG', [
                'property' => $property,
                'propertyCount' => $propertyCount,
                'pendingPropertyCount' => $pendingPropertyCount,
                'successPropertyCount' => $successPropertyCount,
                'rejectedPropertyCount' => $rejectedPropertyCount,
                'fromDate' => $fromDate,
                'toDate' => $toDate,
            ])->setPaper('a4', 'landscape');;

            return $pdf->download('prop_registration_report.pdf');
        }

        return view('administrator.reportGen.propRegManagementReport', [
            'property' => $paginatedUsers,
            'propertyCount' => $propertyCount,
            'pendingPropertyCount' => $pendingPropertyCount,
            'successPropertyCount' => $successPropertyCount,
            'rejectedPropertyCount' => $rejectedPropertyCount,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
            'propertyType' => $propertyType,
        ]);
    }




    public function viewContentCheckerReport()
    {
        $deactivatedTenants = DeactivatedTenant::all();
        $deactivatedAdvertisers = DeactivatedAdvertiser::all();
        $rejectedTenants = RejectedTenant::all();
        $rejectedAdvertisers = RejectedAdvertiser::all();

        $users = new Collection();
        $users = $users->merge($deactivatedTenants);
        $users = $users->merge($deactivatedAdvertisers);
        $users = $users->merge($rejectedTenants);
        $users = $users->merge($rejectedAdvertisers);

        $totalRecordCount = $users->count();
        $totalAdvertiser = $deactivatedAdvertisers->count() + $rejectedAdvertisers->count();
        $totalTenant = $deactivatedTenants->count() + $rejectedTenants->count();

        $tenant = Tenant::all();
        $advertiser = Advertiser::all();

        $userType = 'All'; // Assuming you want to display all user types
        $fromDate = null; // Set a default value
        $toDate = null; // Set a default value

        $perPage = 5;
        $currentPage = Paginator::resolveCurrentPage('page');

        // Paginate the merged collection
        $paginatedUsers = new LengthAwarePaginator(
            $users->forPage($currentPage, $perPage),
            $users->count(),
            $perPage,
            $currentPage,
            [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => 'page',
            ]
        );

        return view('administrator.reportGen.contentCheckerReport', [
            'tenant' => $tenant,
            'advertiser' => $advertiser,
            'totalRecordCount' => $totalRecordCount,
            'totalAdvertiser' => $totalAdvertiser,
            'totalTenant' => $totalTenant,
            'users' => $paginatedUsers,
            'userType' => $userType,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
        ]);
    }

    public function generateContentCheckerReport(Request $request)
    {

        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        $userType = $request->input('user_type');



        $deactivatedTenants = DeactivatedTenant::whereBetween('deactivated_date', [$fromDate, $toDate])->get();
        $deactivatedAdvertisers = DeactivatedAdvertiser::whereBetween('deactivated_date', [$fromDate, $toDate])->get();
        $rejectedTenants = RejectedTenant::whereBetween('rejected_date', [$fromDate, $toDate])->get();
        $rejectedAdvertisers = RejectedAdvertiser::whereBetween('rejected_date', [$fromDate, $toDate])->get();

        $users = new Collection();

        if ($userType === 'All') {
            $users = $users->merge($deactivatedTenants);
            $users = $users->merge($deactivatedAdvertisers);
            $users = $users->merge($rejectedTenants);
            $users = $users->merge($rejectedAdvertisers);
        } elseif ($userType === 'Tenant') {
            $users = $users->merge($deactivatedTenants);
            $users = $users->merge($rejectedTenants);
        } elseif ($userType === 'Advertiser') {
            $users = $users->merge($deactivatedAdvertisers);
            $users = $users->merge($rejectedAdvertisers);
        }


        $totalRecordCount = $users->count();

        $deactivatedAdvertiserCount = ($userType == 'All' || $userType == 'Advertiser') ? $deactivatedAdvertisers->count() : 0;
        $rejectedAdvertisersCount = ($userType == 'All' || $userType == 'Advertiser') ? $rejectedAdvertisers->count() : 0;
        $totalAdvertiser = $deactivatedAdvertiserCount + $rejectedAdvertisersCount;

        $deactivatedTenantCount = ($userType == 'All' || $userType == 'Tenant') ? $deactivatedTenants->count() : 0;
        $rejectedTenantCount = ($userType == 'All' || $userType == 'Tenant') ? $rejectedTenants->count() : 0;
        $totalTenant = $deactivatedTenantCount + $rejectedTenantCount;

        $tenant = Tenant::all();
        $advertiser = Advertiser::all();

        $perPage = 5;
        $currentPage = Paginator::resolveCurrentPage('page');

        // Paginate the merged collection
        $paginatedUsers = new LengthAwarePaginator(
            $users->forPage($currentPage, $perPage),
            $users->count(),
            $perPage,
            $currentPage,
            [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => 'page',
            ]
        );

        if ($request->has('download')) {
            $pdf = Pdf::loadView('administrator.reportGen.contentCheckerReportPNG', [
                'tenant' => $tenant,
                'advertiser' => $advertiser,
                'totalRecordCount' => $totalRecordCount,
                'totalAdvertiser' => $totalAdvertiser,
                'totalTenant' => $totalTenant,
                'users' => $users,
                'userType' => $userType,
                'fromDate' => $fromDate,
                'toDate' => $toDate,
            ])->setPaper('a4', 'landscape');;

            return $pdf->download('content_checker_report.pdf');
        }



        return view('administrator.reportGen.contentCheckerReport', [
            'tenant' => $tenant,
            'advertiser' => $advertiser,
            'totalRecordCount' => $totalRecordCount,
            'totalAdvertiser' => $totalAdvertiser,
            'totalTenant' => $totalTenant,
            'users' => $paginatedUsers,
            'userType' => $userType,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
        ]);
    }
}
