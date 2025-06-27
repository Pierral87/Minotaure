<?php

class Validator {
    public static function isEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function isPasswordStrong($password) {
        return strlen($password) >= 6;
    }

    public static function notEmpty(...$fields) {
        foreach ($fields as $field) {
            if (empty(trim($field))) return false;
        }
        return true;
    }
}
