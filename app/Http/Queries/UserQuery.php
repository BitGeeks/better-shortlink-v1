<?php

namespace App\Http\Queries;

use App\Http\Queries\Filters\FuzzyFilter;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class UserQuery extends QueryBuilder
{
    public function __construct(Request $request)
    {
        $query = User::query()
            ->with('role');

        parent::__construct($query, $request);

        $this->allowedFilters([
            AllowedFilter::custom('search', new FuzzyFilter('name', 'email')),
        ])
            ->allowedSorts([
                'id',
                'name',
                'email',
            ])
            ->defaultSort('id');
    }
}
