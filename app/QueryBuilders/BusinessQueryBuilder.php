<?php

namespace App\QueryBuilders;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class BusinessQueryBuilder
{
    public static function applyFilters(Builder $query, $request)
    {
        if ($request->filled('search')) {
            $query->search($request->search);
        }
        if ($request->filled('filters.status') && $request->filters['status'] !== 'all') {
            $query->status($request->filters['status']);
        }
        if ($request->filled('filters.date_range')) {
            $dateRange = $request->filters['date_range'];
            $startDate = Carbon::createFromFormat('d M Y', $dateRange[0])->startOfDay();
            $endDate = Carbon::createFromFormat('d M Y', $dateRange[1])->endOfDay();
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }
        return $query;
    }
}
