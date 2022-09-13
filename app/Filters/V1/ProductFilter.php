<?php

namespace App\Filters\V1;


use App\Filters\FilterQuery;
use Illuminate\Http\Request;

class ProductFilter extends FilterQuery
{
    protected $safeParams = [
        'id' => ['eq', 'gt', 'gte', 'lt', 'lte'],
        'title' => ['eq'],
        'price' => ['eq', 'gt', 'gte', 'lt', 'lte'],
        'description' => ['eq'],
        'categoryId' => ['eq', 'gt', 'gte', 'lt', 'lte'],
        'image' => ['eq'],
        'comment' => ['eq'],
    ];

    protected $columnMap = [
        'categoryId' => 'category_id',
    ];
}
