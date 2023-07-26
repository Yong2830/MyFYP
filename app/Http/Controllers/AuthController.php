<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Tenant;
use App\Models\Advertiser;
use App\Models\RestrictWord;
use Illuminate\Http\Request;
use App\Models\Administrator;
use App\Rules\EmailValidator;
use App\Rules\RestrictedWord;
use App\Models\RejectedTenant;
use App\Models\DeactivatedTenant;
use App\Models\RejectedAdvertiser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\DeactivatedAdvertiser;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {
        return view('loginRegister.login');
    }

    public function loginTenantForm()
    {
        return view('loginRegister.loginTenant');
    }

    public function loginTenantAction(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'email'         => 'required|email',
            'password'      => 'required',
        ]);

        $user = Tenant::where('email', $input['email'])->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Invalid Email and Password');
        }

        if ($user->tenant_status === 'Deactivated') {
            // Fetch the latest deactivated data from the deactivated_tenant table
            $deactivatedData = DeactivatedTenant::where('tenant_id', $user->tenant_id)
                ->orderBy('deactivated_date', 'desc')
                ->first();

            if ($deactivatedData) {
                // Store the deactivated reason and date in the session
                session()->put('deactivated_reason', $deactivatedData->deactivated_reason);
                session()->put('deactivated_date', $deactivatedData->deactivated_date);
            }

            // Show the modal with the deactivated reason
            return redirect()->back()->with('status', 'deactivated');
        }

        if ($user->registration_status === 'Pending') {
            // Fetch the latest deactivated data from the deactivated_tenant table
            $pendingData = 'Pending';


            session()->put('pending', $pendingData);

            // Show the modal with the deactivated reason
            return redirect()->back()->with('pendingStatus', 'pending');
        } elseif ($user->registration_status === 'Rejected') {
            $rejectedData = RejectedTenant::where('tenant_id', $user->tenant_id)
                ->orderBy('rejected_date', 'desc')
                ->first();

            if ($rejectedData) {
                // Store the deactivated reason and date in the session
                session()->put('rejected_reason', $rejectedData->rejected_reason);
                session()->put('rejected_date', $rejectedData->rejected_date);
            }
            return redirect()->back()->with('rejectedStatus', 'rejected');
        }

        if (Auth::guard('tenant')->attempt([
            'email'     => $input['email'],
            'password'  => $input['password'],
        ])) {
            return redirect()->route('showHome');
        } else {
            return redirect()->back()->with('error', 'Invalid Email and Password');
        }
    }


    public function loginAdvertiserForm()
    {
        return view('loginRegister.loginAdvertiser');
    }

    public function loginAdvertiserAction(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'email'         => 'required|email',
            'password'      => 'required',
        ]);


        $user = Advertiser::where('email', $input['email'])->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Invalid Email and Password');
        }

        if ($user->advertiser_status === 'Deactivated') {
            // Fetch the latest deactivated data from the deactivated_tenant table
            $deactivatedData = DeactivatedAdvertiser::where('advertiser_id', $user->advertiser_id)
                ->orderBy('deactivated_date', 'desc')
                ->first();

            if ($deactivatedData) {
                // Store the deactivated reason and date in the session
                session()->put('deactivated_reason', $deactivatedData->deactivated_reason);
                session()->put('deactivated_date', $deactivatedData->deactivated_date);
            }

            // Show the modal with the deactivated reason
            return redirect()->back()->with('status', 'deactivated');;
        }

        if ($user->registration_status === 'Pending') {
            // Fetch the latest deactivated data from the deactivated_tenant table
            $pendingData = 'Pending';


            session()->put('pending', $pendingData);

            // Show the modal with the deactivated reason
            return redirect()->back()->with('pendingStatus', 'pending');
        }elseif ($user->registration_status === 'Rejected') {
            $rejectedData = RejectedAdvertiser::where('advertiser_id', $user->advertiser_id)
                ->orderBy('rejected_date', 'desc')
                ->first();

            if ($rejectedData) {
                // Store the deactivated reason and date in the session
                session()->put('rejected_reason', $rejectedData->rejected_reason);
                session()->put('rejected_date', $rejectedData->rejected_date);
            }
            return redirect()->back()->with('rejectedStatus', 'rejected');
        }


        if (Auth::guard('advertiser')->attempt([
            'email'     => $input['email'],
            'password'  => $input['password'],
        ])) {
            return redirect()->route('advertiser.advertiserTest');
        } else {
            return redirect()->back()->with('error', 'Invalid Email and Password');
        }
    }

    public function loginAdministratorForm()
    {
        return view('loginRegister.loginAdministrator');
    }

    public function loginAdministratorAction(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'email'         => 'required|email',
            'password'      => 'required',
        ]);


        if (Auth::guard('administrator')->attempt([
            'email'     => $input['email'],
            'password'  => $input['password'],
        ])) {
            return redirect()->route('homepage');        } 
            else {
            return redirect()->back()->with('error', 'Invalid Email and Password');
        }
    }


    public function registerType()
    {
        return view('loginRegister.registerType');
    }

    public function registerTenant()
    {
        return view('loginRegister.registerTenant');
    }

    public function registerTenantStore(Request $request)
    {


        $request->validate([
            'tenant_name'           => ['required', 'max:50', new RestrictedWord],
            'email'             => ['required', 'email', 'max:100', new EmailValidator],
            'tenant_contact'        => 'required|max:15',
            'password'              => 'required|max:20',
            'tenant_DOB'            => 'required'
        ]);

        $latestTenant = Tenant::latest('tenant_id')->first();
        $lastTenantId = $latestTenant ? $latestTenant->tenant_id : 'T0000';
        $tenantId = 'T' . str_pad((int) substr($lastTenantId, 1) + 1, 4, '0', STR_PAD_LEFT);

        Tenant::create([
            'tenant_id'             => $tenantId,
            'tenant_name'           => $request->tenant_name,
            'email'                 => $request->email,
            'tenant_contact'        => $request->tenant_contact,
            'password'              => Hash::make($request->password),
            'tenant_status'         => 'Activated',
            'registration_date'     => Carbon::now(),
            'registration_status'   => 'Pending',
            'tenant_DOB'            => $request->tenant_DOB,
        ]);

        return redirect()->route('login')->with('info', 'Done registration for Tenant!');
    }

    public function registerAdvertiser()
    {
        return view('loginRegister.registerAdvertiser');
    }

    public function checkRestrictedWords($name)
    {
        $restrictedWords = RestrictWord::pluck('word_name')->toArray();

        foreach ($restrictedWords as $restrictedWord) {
            if (stripos($name, $restrictedWord) !== false) {
                // Name contains a restricted word
                return true;
            }
        }

        // Name is valid (does not contain any restricted words)
        return false;
    }


    public function registerAdvertiserStore(Request $request)
    {

        $name = $request->advertiser_name; // Get the value from the 'Name' field in the form

        // Perform the restricted words check for the name field
        $nameContainsRestrictedWord = $this->checkRestrictedWords($name);
        if ($nameContainsRestrictedWord) {
            return redirect()->back()->withErrors(['message' => 'The name contains a restricted word.']);
        }

        $request->validate([
            'advertiser_name'           => 'required|max:50',
            'email'                     => ['required', 'email', 'max:100', new EmailValidator],
            'advertiser_contact'        => 'required|max:15',
            'password'       => 'required|max:20',
            'advertiser_DOB'            => 'required'
        ]);

        $latestAdvertiser = Advertiser::latest('advertiser_id')->first();
        $lastAdvertiserId = $latestAdvertiser ? $latestAdvertiser->advertiser_id : 'A0000';
        $advertiserId = 'A' . str_pad((int) substr($lastAdvertiserId, 1) + 1, 4, '0', STR_PAD_LEFT);

        Advertiser::create([
            'advertiser_id'             => $advertiserId,
            'advertiser_name'           => $request->advertiser_name,
            'email'                     => $request->email,
            'advertiser_contact'        => $request->advertiser_contact,
            'password'                  => Hash::make($request->password),
            'advertiser_status'         => 'Activated',
            'registration_date'         => Carbon::now(),
            'registration_status'       => 'Pending',
            'advertiser_DOB'            => $request->advertiser_DOB,
        ]);

        return redirect()->route('login')->with('info', 'Done registration for advertiser!');
    }

    public function logoutTenant()
    {
        Auth::guard('tenant')->logout();
        return redirect()->route('login');
    }

    public function logoutAdvertiser()
    {
        Auth::guard('advertiser')->logout();
        return redirect()->route('login');
    }

    public function logoutAdministrator()
    {
        Auth::guard('administrator')->logout();
        return redirect()->route('login');
    }
}
