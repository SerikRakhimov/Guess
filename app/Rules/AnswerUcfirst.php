<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

// из https://snipp.ru/php/more-mb-string
if (!function_exists('mb_ucfirst')) {
    function mb_ucfirst($str, $enc = 'utf-8') {
        return
            mb_strtoupper(mb_substr($str, 0, 1, $enc), $enc) .
            mb_substr($str, 1, mb_strlen($str, $enc), $enc);
    }
}

class AnswerUcfirst implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //
        return mb_ucfirst(mb_strtolower($value)) == $value;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Слово должно начинаться с заглавной буквы, остальные буквы - строчные.';
    }
}
