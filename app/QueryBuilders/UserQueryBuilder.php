<?php

namespace App\QueryBuilders;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class UserQueryBuilder
{
    public static function applyFilters(Builder $query, $request)
    {
        $query->where('id', '!=', auth()->user()->id)
            ->where('business_id', $request->user()->business_id);

        if ($request->filled('search')) {
            $query->search(strval($request->search));
        }

        if ($request->filled('filters.role_id') && $request->filters['role_id']) {
            $query->where('role_id',$request->filters['role_id']);
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
