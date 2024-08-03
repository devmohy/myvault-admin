<?php

namespace App\Http\Controllers\Roles;

use Carbon\Carbon;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use App\Http\Controllers\BaseController;

class IndexRoleController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $startDate = null;
        $endDate = null;
        if ($request->filled('filters.date_range')) {
            $dateRange = $request->filters['date_range'];
            $startDate = Carbon::createFromFormat('d M Y', $dateRange[0])->startOfDay();
            $endDate = Carbon::createFromFormat('d M Y', $dateRange[1])->endOfDay();
        }
        $query = Role::where('business_id', $request->user()->business_id);
        $query = $query->when($request->search, fn($q)=>$q->search($request->search));
        $query = $query->when($request->filters && $request->filters['status'] && $request->filters['status'] !=='all', fn ($q) => $q->status($request->filters['status']));
        $query = $query->when($startDate && $endDate, fn ($q) => $q->whereBetween('created_at', [$startDate, $endDate]));
        $roles = $query->latest()->paginate($request->per_page ?? 10);
        return $this->sendResponse($roles, "Roles retrieved successfully", 200, function ($items) {
            return RoleResource::collection($items);
        });
    }
}
