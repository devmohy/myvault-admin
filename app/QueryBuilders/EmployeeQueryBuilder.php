<?php

namespace App\QueryBuilders;

use Carbon\Carbon;
use App\Enum\EmployeeStatusEnum;
use Illuminate\Database\Eloquent\Builder;

class EmployeeQueryBuilder
{
    public static function applyFilters(Builder $query, $request)
    {
        $query->where('status', '!=', EmployeeStatusEnum::DELETED);

        if ($request->filled('search')) {
            $query->search($request->search);
        }
        
        if (auth()->user()->business_id) {
            $query->where('business_id', '=', auth()->user()->business_id);
        }

        if ($request->filled('filters.businessId')) {
            $query->where('business_id', '=', $request->filters['businessId']);
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
