<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;

class StrongPassword implements Rule
{
    public function passes($attribute, $value)
    {
        return preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[\W_]).{8,}$/', $value);
    }

    public function message()
    {
        return 'Password harus mengandung huruf besar, kecil, angka, dan karakter khusus.';
    }
}
