<?php
namespace App\Validations;

class AddBankAccountValidateRules
{
    public static function rules(): array
    {
        return [
            'selectedBank' => 'required',
            'bankAccountNumber' => 'required'
        ];
    }
}
