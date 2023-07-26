<?php

namespace App\Rules;

use App\Models\RestrictWord;
use Closure;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;


class RestrictedWord implements Rule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function passes($attribute, $value)
    {
        // Get all restricted words from the database
        $restrictedWords = RestrictWord::pluck('word_name')->toArray();

        // Check if the user input contains any restricted words
        foreach ($restrictedWords as $word) {
            if (stripos($value, $word) !== false) {
                return false; // The input contains a restricted word
            }
        }

        return true; // The input is valid, no restricted words found
    }

    public function message()
    {
        return 'The :attribute contains a restricted word.';
    }
}
