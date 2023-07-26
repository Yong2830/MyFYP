<?php

namespace App\Rules;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Contracts\Validation\Rule;

class GoogleAddressValidator implements Rule
{
    public function passes($attribute, $value)
    {
        $addressToValidate = $value;
        $state = request('property_address_state');
        $postal = request('property_postal');
        $apiKey = 'AIzaSyBXYCw8sSpsLk3xfAjeuosLGUvfYSrrvmY';
        $client = new Client();

        // Combine the address, state, and postal code
        $addressToValidate .= ", {$state}, {$postal}";

        $url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($addressToValidate) . "&key={$apiKey}";

        try {
            $response = $client->get($url);
            $data = json_decode($response->getBody(), true);

            // Check if the API response contains valid address data
            return !empty($data['results']);
        } catch (Exception $e) {
            // Error occurred while making the API request
            return false;
        }
    }

    public function message()
    {
        return 'Invalid address. Please provide a valid property address, state, and postal code.';
    }
}
