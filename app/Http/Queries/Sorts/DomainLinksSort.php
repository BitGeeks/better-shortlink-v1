<?php

namespace App\Http\Queries\Sorts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Spatie\QueryBuilder\Sorts\Sort;

class DomainLinksSort implements Sort
{
    public function __invoke(Builder $query, bool $descending, string $property)
    {
        $direction = $descending ? 'DESC' : 'ASC';

        $query->orderBy(function (QueryBuilder $query) {
            $query->selectRaw('count(*) as links_count')
                ->from('links')
                ->whereColumn('domain_id', 'domains.id');
        }, $direction);
    }
}
