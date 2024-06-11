<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;

class SettingsTodosFilter extends ApiFilter
{
    protected $safeParms = [
        'name' => ['eq'],
        'type' => ['eq'],
        'status' => ['eq'],
    ];
    protected $operatorMap = [
        'eq' => '=',
    ];
}