<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Http;

class EmailValidator implements Rule
{
    public function passes($attribute, $value)
    {
        $key = "4pnLO63s0LmIHcBMOOZFl";
        $url = "https://apps.emaillistverify.com/api/verifyEmail?secret=" . $key . "&email=" . $value;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $response = curl_exec($ch);
        curl_close($ch);

        // Decode the JSON response

        // Check if the 'status' key exists in the response and its value is 'ok'
        return $response === "ok";
    }

    public function message()
    {
        return 'The :attribute is not a valid email address.';
    }
}
