<?php

namespace App\Http\Controllers\advertiser;

use App\Models\Advertiser;
use App\Models\RestrictWord;
use Illuminate\Http\Request;
use App\Rules\EmailValidator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function viewProfileForm()
    {
        $advertiser = auth()->guard('advertiser')->user();
        return view('advertiser.profile.profile', ['advertiser' => $advertiser]);
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


    public function updateProfile(Request $request)
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
            'password'                  => 'required|max:20|confirmed',
            'password_confirmation'     => 'required',
            'advertiser_DOB'            => 'required'
        ]);

        $advertiserId = auth()->guard('advertiser')->user()->advertiser_id;
        $advertiser = Advertiser::findOrFail($advertiserId);

        $advertiser->update([
            'advertiser_name'       => $request->advertiser_name,
            'email'                 => $request->email,
            'advertiser_contact'    => $request->advertiser_contact,
            'password'              => Hash::make($request->password),
            'advertiser_DOB'        => $request->advertiser_DOB,
        ]);

        return redirect()->route('viewProfileForm')->with('info', 'Done updating the the profile settings!');
    }
}
