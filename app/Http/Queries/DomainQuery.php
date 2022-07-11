<?php

namespace App\Http\Queries;

use App\Http\Queries\Filters\FuzzyFilter;
use App\Http\Queries\Sorts\DomainLinksSort;
use App\Models\Domain;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

class DomainQuery extends QueryBuilder
{
    public function __construct(Request $request)
    {
        $query = Domain::query()
            ->withCount('links');

        parent::__construct($query, $request);

        $this->allowedFilters([
            AllowedFilter::custom('search', new FuzzyFilter('name')),
        ])
            ->allowedSorts([
                'id',
                'name',
                AllowedSort::custom('links_count', new DomainLinksSort()),
            ])
            ->defaultSort('id');
    }
}
