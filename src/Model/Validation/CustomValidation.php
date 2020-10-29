<?php
namespace App\Model\Validation;

use Cake\Validation\Validation;

class CustomValidation extends Validation {
    /**
     * 半角英数字チェック
     * @param string $value
     * @return bool
     */
    public static function alphaNumeric($value) {
        return (bool) preg_match('/^[a-zA-Z0-9]+$/', $value);
    }
}
