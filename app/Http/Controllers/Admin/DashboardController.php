<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Click;
use App\Models\Link;
use App\Models\Meta\Browser;
use App\Models\Meta\Country;
use App\Models\Meta\Device;
use App\Models\Meta\Platform;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /** @var Link|null $link */
    private $link;

    /** @var string DATE_FORMAT */
    private const DATE_FORMAT = 'm/d/Y';

    /**
     * Get analytics data for all links or the given one
     * 
     * @param null|\App\Models\Link $link 
     * @return array 
     * @throws \RuntimeException 
     * @throws \InvalidArgumentException 
     */
    public function __invoke(Request $request, ?Link $link = null): array
    {
        $this->link = $link;

        return [
            'platforms' => $this->getStats(Platform::query()),
            'devices' => $this->getStats(Device::query()),
            'browsers' => $this->getStats(Browser::query()),
            'countries' => $this->getStats(Country::query()),
            'clicks' => $this->getChart(),
        ];
    }

    /**
     * Get clicks chart data for Chart.js
     * 
     * @return array 
     * @throws \InvalidArgumentException 
     */
    public function getChart(): array
    {
        /** @var \Illuminate\Support\Collection $clicks */
        $clicks = Click::selectRaw('count(*) as total, created_at')
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d')"))
            ->when($this->link, function (Builder $query) {
                $query->where('link_id', $this->link->id);
            })
            ->get()
            ->sortBy('created_at');

        $labels = $clicks->pluck('created_at')
            ->map(function ($period) {
                return $period->format(static::DATE_FORMAT);
            });

        $values = $clicks->pluck('total');

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'data' => $values,
                    'backgroundColor' => 'rgba(52, 170, 68, 0.2)',
                    'borderColor' => 'rgba(52, 170, 68, 1)',
                ],
            ],
        ];
    }

    /**
     * Get click rate stats for given model
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query 
     * @return \Illuminate\Database\Eloquent\Collection 
     * @throws \RuntimeException 
     * @throws \InvalidArgumentException 
     */
    public function getStats(Builder $query): Collection
    {
        /** @var Collection $entries */
        $entries = $query->has('clicks')
            ->when($this->link, function (Builder $query) {
                $query->whereHas('clicks', function (Builder $query) {
                    $query->where('link_id', $this->link->id);
                });
            })
            ->orderBy(function (QueryBuilder $builder) use ($query) {
                $builder->selectRaw('count(*) as clicks_count')
                    ->from('clicks')
                    ->whereColumn(
                        $query->getModel()->getForeignKey(),
                        $query->getRelation('clicks')->getQualifiedParentKeyName()
                    )->when($this->link, function (QueryBuilder $query) {
                        $query->where('link_id', $this->link->id);
                    });
            }, 'desc')
            ->withCount([
                'clicks' => function (Builder $query) {
                    $query->when($this->link, function (Builder $query) {
                        $query->where('link_id', $this->link->id);
                    });
                }
            ])
            ->limit(10)
            ->get();

        $totalClicks = $entries->sum('clicks_count');

        return $entries->map(function ($entry) use ($totalClicks) {
            $entry->clicks_rate = round($entry->clicks_count / $totalClicks * 100, 2);

            return $entry;
        })
            ->sortByDesc('clicks_count');
    }
}
