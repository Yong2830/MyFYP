<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\Tenant;
use App\Models\Advertiser;
use App\Mail\TenantRejected;
use Illuminate\Http\Request;
use App\Models\RejectedTenant;
use App\Models\PropertyListing;
use App\Models\RejectedAdvertiser;
use App\Mail\ApprovalPropertyEmail;
use App\Http\Controllers\Controller;
use App\Mail\AdvertiserApproved;
use App\Mail\AdvertiserRejected;
use App\Mail\RejectionPropertyEmail;
use App\Mail\TenantApproved;
use Illuminate\Support\Facades\Mail;
use Illuminate\Pagination\Paginator;



class ApprovalController extends Controller
{
    public function tenantApproval()
    {
        $tenants = Tenant::whereIn('registration_status', ['Pending', 'Rejected'])->paginate(5);
        return view('administrator.registrationApproval.tenantApproval', ['tenants' => $tenants]);
    }

    public function showTenant($id)
    {
        $tenant = Tenant::findOrFail($id);
        return view('administrator.registrationApproval.tenantAppShow', ['tenant' => $tenant]);
    }

    public function rejectedTenant($id, Request $request)
    {

        $request->validate([
            'rejected_reason'           => 'required|max:500'
        ]);

        $tenant = Tenant::findOrFail($id);
        $tenant->registration_status = 'Rejected';
        $tenant->save();

        $reason = $request->rejected_reason;
        Mail::to($tenant->email)->send(new TenantRejected($reason));

        $lastRt = RejectedTenant::latest('rejected_tenant_id')->first();
        $lastRtId = $lastRt ? $lastRt->rejected_tenant_id : 'RT0000';
        $rtId = 'RT' . str_pad((int) substr($lastRtId, 2) + 1, 4, '0', STR_PAD_LEFT);

        RejectedTenant::create([
            'rejected_tenant_id'             => $rtId,
            'rejected_date'                     => Carbon::now(),
            'rejected_reason'                   => $request->rejected_reason,
            'tenant_id'                         => $id,
        ]);

        return redirect()->route('tenantApproval')->with('success', 'Tenant rejected successfully');
    }

    public function approveTenant($id)
    {
        $tenant = Tenant::findOrFail($id);
        $tenant->registration_status = 'Success';
        $tenant->save();

        Mail::to($tenant->email)->send(new TenantApproved());



        return redirect()->route('tenantApproval')->with('success', 'Tenant approved successfully');
    }



    public function landlordApproval()
    {

        $advertisers = Advertiser::whereIn('registration_status', ['Pending', 'Rejected'])->paginate(5);
        return view('administrator.registrationApproval.landlordApproval', ['advertisers' => $advertisers]);
    }

    public function showAdvertiser($id)
    {
        $advertiser = advertiser::findOrFail($id);
        return view('administrator.registrationApproval.advertiserAppShow', ['advertiser' => $advertiser]);
    }

    public function rejectedAdvertiser($id, Request $request)
    {

        $request->validate([
            'rejected_reason'           => 'required|max:500'
        ]);

        $advertiser = Advertiser::findOrFail($id);
        $advertiser->registration_status = 'Rejected';
        $advertiser->save();

        $reason = $request->rejected_reason;
        Mail::to($advertiser->email)->send(new AdvertiserRejected($reason));

        $lastRa = RejectedAdvertiser::latest('rejected_advertiser_id')->first();
        $lastRaId = $lastRa ? $lastRa->rejected_advertiser_id : 'RA0000';
        $raId = 'RA' . str_pad((int) substr($lastRaId, 2) + 1, 4, '0', STR_PAD_LEFT);

        RejectedAdvertiser::create([
            'rejected_advertiser_id'             => $raId,
            'rejected_date'                     => Carbon::now(),
            'rejected_reason'                   => $request->rejected_reason,
            'advertiser_id'                         => $id,
        ]);

        return redirect()->route('landlordApproval')->with('success', 'Advertiser rejected successfully');
    }

    public function approveAdvertiser($id)
    {
        $advertiser = Advertiser::findOrFail($id);
        $advertiser->registration_status = 'Success';
        $advertiser->save();

        Mail::to($advertiser->email)->send(new AdvertiserApproved());

        return redirect()->route('landlordApproval')->with('success', 'Advertiser approved successfully');
    }


    public function showAllPropertyApproval()
    {
        $property = PropertyListing::whereIn('property_posting_status', ['Pending'])->paginate(5);
        return view('administrator.registrationApproval.propertyApproval', ['property' => $property]);
    }

    public function showProperty($propertyId)
    {
        $property = PropertyListing::findOrFail($propertyId);
        return view('administrator.registrationApproval.showProperty', ['property' => $property]);
    }

    public function handleApproveRejectRequest(Request $request, $propertyId)
    {
        $property = PropertyListing::findOrFail($propertyId);
        $advertiserEmail = Advertiser::where('advertiser_id', $property->advertiser_id)
            ->value('email');

        $property = PropertyListing::findOrFail($propertyId);
        $advertiserEmail = Advertiser::where('advertiser_id', $property->advertiser_id)->value('email');

        if ($request->has('action')) {
            $action = $request->input('action');

            if ($action === 'approve') {
                $request->validate([
                    'reject_reason' => 'prohibited',
                ]);

                $property->update([
                    'property_posting_status' => 'Approve',
                    'reject_reason' => null,
                ]);

                Mail::to($advertiserEmail)->send(new ApprovalPropertyEmail($property));

                return redirect()->route('showAllPropertyApproval')->with('info', 'The property has been approved!');
            } elseif ($action === 'reject') {
                $request->validate([
                    'reject_reason' => 'required',
                ]);

                $property->update([
                    'property_posting_status' => 'Reject',
                    'reject_reason' => $request->reject_reason,
                ]);

                Mail::to($advertiserEmail)->send(new RejectionPropertyEmail($property, $request->reject_reason));

                return redirect()->route('showAllPropertyApproval')->with('info', 'The property has been rejected!');
            }
        }
    }
}
