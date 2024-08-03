<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\AuditTrail;
use Illuminate\Http\Request;
use App\Http\Resources\AuditTrailResource;
use App\QueryBuilders\AuditTrailQueryBuilder;

class AuditTrailController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $startDate = null;
        $endDate = null;
        if ($request->filled('filters.date_range')) {
            $dateRange = $request->filters['date_range'];
            $startDate = Carbon::createFromFormat('d M Y', $dateRange[0])->startOfDay();
            $endDate = Carbon::createFromFormat('d M Y', $dateRange[1])->endOfDay();
        }

        $query = AuditTrail::query();
        $query = AuditTrailQueryBuilder::applyFilters($query, $request);


        $auditTrails = $query->latest()->paginate(10);
        return $this->sendResponse($auditTrails, "Audit trails retrieved successfully", 200, function ($items) {
            return AuditTrailResource::collection($items);
        });
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AuditTrail $auditTrail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AuditTrail $auditTrail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AuditTrail $auditTrail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AuditTrail $auditTrail)
    {
        //
    }
}
