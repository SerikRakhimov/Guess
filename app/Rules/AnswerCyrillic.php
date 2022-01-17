<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AnswerCyrillic implements Rule
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
        $chr_ru = "А-Яа-яЁё0-9\s`~!@#$%^&*()_+-={}|:;<>?,.\/\"\'\\\[\]";

        return (preg_match("/^[$chr_ru]+$/u", $value));
    }
    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Допустимы только символы русского алфавита';
    }
}
