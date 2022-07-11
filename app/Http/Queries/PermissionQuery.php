<?php

namespace App\Http\Queries;

use App\Http\Queries\Filters\FuzzyFilter;
use App\Models\Permission\Permission;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class PermissionQuery extends QueryBuilder
{
    public function __construct(Request $request)
    {
        $query = Permission::query();

        parent::__construct($query, $request);

        $this->allowedFilters([
            AllowedFilter::custom('search', new FuzzyFilter('name')),
        ])
            ->allowedSorts([
                'id',
                'name',
            ])
            ->defaultSort('name');
    }
}
