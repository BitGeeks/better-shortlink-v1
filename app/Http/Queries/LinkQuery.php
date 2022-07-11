<?php

namespace App\Http\Queries;

use App\Http\Queries\Filters\LinkFilter;
use App\Http\Queries\Sorts\LinkClicksSort;
use App\Models\Link;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

class LinkQuery extends QueryBuilder
{
    public function __construct(Request $request)
    {
        $query = Link::query()
            ->with('domain')
            ->withCount('clicks');

        parent::__construct($query, $request);

        $this->allowedFilters([
            AllowedFilter::custom('search', new LinkFilter('url', 'title', 'description')),
        ])
            ->allowedSorts([
                'id',
                'domain_id',
                'url',
                'password',
                'expires_at',
                AllowedSort::custom('clicks_count', new LinkClicksSort()),
            ])
            ->defaultSort('id');
    }
}
