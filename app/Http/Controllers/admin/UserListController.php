<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\Tenant;
use App\Models\Advertiser;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Administrator;
use App\Rules\EmailValidator;
use App\Models\DeactivatedTenant;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Models\DeactivatedAdvertiser;


class UserListController extends Controller
{
    public function viewAdmin()
    {
        $admins = Administrator::paginate(5);
        return view('administrator.userManagement.adminView', ['admins' => $admins]);
    }

    public function adminCreate()
    {
        return view('administrator.userManagement.adminCreate');
    }

    public function adminStore(Request $request)
    {
        $request->validate([
            'administrator_name'           => 'required|max:50',
            'email'             => ['required', 'email', 'max:100', new EmailValidator],
            'administrator_contact'        => 'required|max:15',
            'password'              => 'required|max:20',
            'administrator_DOB'            => 'required'
        ]);

        $lastAdmin = Administrator::latest('administrator_id')->first();
        $lastAdminId = $lastAdmin ? $lastAdmin->administrator_id : 'AD0000';
        $adminId = 'AD' . str_pad((int) substr($lastAdminId, 2) + 1, 4, '0', STR_PAD_LEFT);

        Administrator::create([
            'administrator_id'             => $adminId,
            'administrator_name'           => $request->administrator_name,
            'email'                 => $request->email,
            'administrator_contact'        => $request->administrator_contact,
            'password'              => Hash::make($request->password),
            'registration_date'     => Carbon::now(),
            'registration_status'   => 'Success',
            'administrator_DOB'            => $request->administrator_DOB,
        ]);

        return redirect()->route('viewAdmin')->with('info', 'Done registration for Admin!');
    }

    public function adminProfileView()
    {

        $administrator = auth()->guard('administrator')->user();
        return view('administrator.profileAdmin', ['administrator' => $administrator]);
    }

    public function updateAdminProfile(Request $request)
    {
        $request->validate([
            'administrator_name'           => 'required|max:50',
            'email'             => ['required', 'email', 'max:100', new EmailValidator],
            'administrator_contact'        => 'required|max:15',
            'password'                  => 'required|max:20|confirmed',
            'password_confirmation'     => 'required',
            'administrator_DOB'            => 'required'
        ]);

        $administratorId = auth()->guard('administrator')->user()->administrator_id;
        $administrator = Administrator::findOrFail($administratorId);

        $administrator->update([
            'administrator_name'       => $request->administrator_name,
            'email'                 => $request->email,
            'administrator_contact'    => $request->administrator_contact,
            'password'              => Hash::make($request->password),
            'administrator_DOB'        => $request->administrator_DOB,
        ]);

        return redirect()->route('adminProfileView')->with('info', 'Done updating the the profile settings!');
    }

    public function destroyAdmin(string $id)
    {
        $admin = Administrator::findOrFail($id);
        $admin->delete();
        return redirect()->route('viewAdmin')->with('info', 'The selected admin deleted successfully.');
    }




    public function viewTenant()
    {
        $tenants = Tenant::where('registration_status', 'Success')->where('registration_status', '!=', 'Pending')->paginate(5);
        return view('administrator.userManagement.tenantList', ['tenants' => $tenants]);
    }

    public function showTenant($id)
    {
        $tenant = Tenant::findOrFail($id);
        return view('administrator.userManagement.tenantShow', ['tenant' => $tenant]);
    }

    public function deactivateTenant($id, Request $request)
    {

        $request->validate([
            'deactivated_reason'           => 'required|max:500'
        ]);

        $tenant = Tenant::findOrFail($id);
        $tenant->tenant_status = 'Deactivated';
        $tenant->save();

        $lastDt = DeactivatedTenant::latest('deactivated_tenant_id')->first();
        $lastDtId = $lastDt ? $lastDt->deactivated_tenant_id : 'DT0000';
        $dtId = 'DT' . str_pad((int) substr($lastDtId, 2) + 1, 4, '0', STR_PAD_LEFT);

        DeactivatedTenant::create([
            'deactivated_tenant_id'             => $dtId,
            'deactivated_date'                  => Carbon::now(),
            'deactivated_reason'                => $request->deactivated_reason,
            'tenant_id'                         => $id,
        ]);

        return redirect()->route('viewTenant')->with('success', 'Tenant deactivated successfully');
    }

    public function activateTenant($id)
    {
        $tenant = Tenant::findOrFail($id);
        $tenant->tenant_status = 'Activated';
        $tenant->save();

        return redirect()->route('viewTenant')->with('success', 'Tenant activated successfully');
    }




    public function viewLandlord()
    {
        $advertisers = Advertiser::where('registration_status', 'Success')->paginate(5);
        return view('administrator.userManagement.landLordlist', ['advertisers' => $advertisers]);

        
    }

    public function showAdvertiser($id)
    {
        $advertiser = advertiser::findOrFail($id);
        return view('administrator.userManagement.advertiserShow', ['advertiser' => $advertiser]);
    }

    public function deactivateAdvertiser($id, Request $request)
    {

        $request->validate([
            'deactivated_reason'           => 'required|max:500'
        ]);

        $advertiser = Advertiser::findOrFail($id);
        $advertiser->advertiser_status = 'Deactivated';
        $advertiser->save();

        $lastDa = DeactivatedAdvertiser::latest('deactivated_advertiser_id')->first();
        $lastDaId = $lastDa ? $lastDa->deactivated_advertiser_id : 'DA0000';
        $daId = 'DA' . str_pad((int) substr($lastDaId, 2) + 1, 4, '0', STR_PAD_LEFT);

        DeactivatedAdvertiser::create([
            'deactivated_advertiser_id'             => $daId,
            'deactivated_date'                  => Carbon::now(),
            'deactivated_reason'                => $request->deactivated_reason,
            'advertiser_id'                         => $id,
        ]);

        return redirect()->route('viewLandlord')->with('success', 'Advertiser deactivated successfully');
    }

    public function activateAdvertiser($id)
    {
        $advertiser = Advertiser::findOrFail($id);
        $advertiser->advertiser_status = 'Activated';
        $advertiser->save();

        return redirect()->route('viewLandlord')->with('success', 'Advertiser activated successfully');
    }
}
