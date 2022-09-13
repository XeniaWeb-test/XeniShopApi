<?php

namespace App\Filters\V1;


use App\Filters\FilterQuery;
use Illuminate\Http\Request;

class CategoryFilter extends FilterQuery
{
    protected $safeParams = [
        'id' => ['eq', 'gt', 'gte', 'lt', 'lte'],
        'title' => ['eq'],
        'description' => ['eq'],
    ];
}
