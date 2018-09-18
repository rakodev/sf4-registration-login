<?php

namespace App\Utils;

/**
 * Class Validation
 * @package App\Utils
 */
class Validation
{
    /**
     * @param $plainTextPassword
     * @return bool
     */
    public function isPasswordPatternValid($plainTextPassword)
    {
        $passwordPattern = '/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/';
        if(!preg_match($passwordPattern,$plainTextPassword)) {
            return false;
        }
        return true;
    }
}