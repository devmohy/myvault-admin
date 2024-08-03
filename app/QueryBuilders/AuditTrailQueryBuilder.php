<?php

namespace App\QueryBuilders;

use Carbon\Carbon;
use App\Enum\EmployeeStatusEnum;
use Illuminate\Database\Eloquent\Builder;

class AuditTrailQueryBuilder
{
    public static function applyFilters(Builder $query, $request)
    {
        if ($request->filled('search')) {
            $query->search($request->search);
        } 
        $query->where('business_id', auth()->user()->business_id);
    
        if ($request->filled('filters.businessId')) {
            $query->where('business_id', '=', $request->filters['businessId']);
        }
        if ($request->filled('filters.event_type')) {
            $query->where('event_type', '=', $request->filters['event_type']);
        }

        if ($request->filled('filters.status') && $request->filters['status'] !== 'all') {
            $query->status($request->filters['status']);
        }

        if ($request->userId) {
            $query = $query->where('user_id', $request->userId); 
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
