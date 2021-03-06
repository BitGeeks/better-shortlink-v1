<?php

namespace App\Http\Queries\Filters;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class LinkFilter implements Filter
{
    /** @var string[] */
    protected $fields;

    public function __construct(string ...$fields)
    {
        $this->fields = $fields;
    }

    public function __invoke(Builder $builder, $values, string $property): Builder
    {
        $builder->where(function (Builder $builder) use ($values): void {
            $builder->where(function (Builder $builder) use ($values): void {
                foreach ($this->fields as $field) {
                    $values = (array) $values;
                    foreach ($values as $value) {
                        $builder->orWhere($field, 'LIKE', "%{$value}%");
                    }
                }
            })
                ->orWhere(function (Builder $builder) use ($values) {
                    $builder->whereHas('tags', function (Builder $builder) use ($values) {
                        $builder->where('value', 'like',  "%{$values}%");
                    });
                });
        });

        return $builder;
    }
}
