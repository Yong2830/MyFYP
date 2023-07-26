<?php

namespace App\Rules;

use Google\Cloud\Vision\V1\ImageAnnotatorClient;
use Illuminate\Contracts\Validation\Rule;

class ImageDetectorRule implements Rule
{
    private $imageAnnotatorClient;

    public function __construct()
    {
        $this->imageAnnotatorClient = new ImageAnnotatorClient([
            'credentials' => config_path('tactical-snow-392708-891d3994f6f7.json'),
        ]);
    }

    public function passes($attribute, $value)
    {
        $imagePath = $value->path(); // Get the temporary path of the uploaded image

        try {
            $image = file_get_contents($imagePath);

            $response = $this->imageAnnotatorClient->safeSearchDetection($image);
            $safeSearch = $response->getSafeSearchAnnotation();

            $likelihood_status = [
                'adult' => $safeSearch->getAdult(),
                'spoof' => $safeSearch->getSpoof(),
                'violence' => $safeSearch->getViolence(),
                'racy' => $safeSearch->getRacy(),
            ];

            // Check if any of the likelihoods are above the threshold (3)
            $isSafe = !($likelihood_status['adult'] >= 3 || $likelihood_status['spoof'] >= 3 || $likelihood_status['violence'] >= 3 || $likelihood_status['racy'] >= 3);
        } catch (\Exception $e) {
            // Error occurred during moderation request, handle accordingly
            $isSafe = false;
        }

        return $isSafe;
    }

    public function message()
    {
        return 'The :attribute contains sensitive content and cannot be uploaded.';
    }
}
