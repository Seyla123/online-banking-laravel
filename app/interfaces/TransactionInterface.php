<?php

namespace App\Interfaces;

interface TransactionInterface
{
    public function process(array $data);
}