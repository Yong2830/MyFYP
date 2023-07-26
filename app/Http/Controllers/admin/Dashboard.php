<?php

namespace App\Http\Controllers\admin;

use App\Models\Tenant;
use App\Models\Advertiser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Administrator;
use App\Models\PropertyListing;
use App\Models\RestrictWord;
use App\Rules\RestrictedWord;

class Dashboard extends Controller
{
    public function homepage()
    {   
        $tenantCount = Tenant::where('registration_status', 'Success')->where('registration_status', '!=', 'Pending')->count();
        $advertiserCount = Advertiser::where('registration_status', 'Success')->count();
        $adminCount = Administrator::count();

        $pendingTenantCount = Tenant::where('registration_status', '!=', 'Success')->count();
        $pendingAdvertiserCount = Advertiser::where('registration_status', '!=', 'Success')->count();
        $pendingPropertyCount = PropertyListing::where('property_posting_status', '!=', 'Approve')->count();

        $wordCount = RestrictWord::count();



        return view('administrator.administratorDashboard', [
            'tenantCount' => $tenantCount,
            'advertiserCount' => $advertiserCount,
            'adminCount' => $adminCount,
            'pendingTenantCount' => $pendingTenantCount,
            'pendingAdvertiserCount' => $pendingAdvertiserCount,
            'pendingPropertyCount' => $pendingPropertyCount,
            'wordCount' => $wordCount,



        ]);
    }
}
