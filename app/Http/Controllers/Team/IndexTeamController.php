<?php

namespace App\Http\Controllers\Team;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\QueryBuilders\UserQueryBuilder;
use App\Http\Controllers\BaseController;
use App\Http\Resources\TeamMemberResource;

class IndexTeamController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $query = User::query();
    
        $query = UserQueryBuilder::applyFilters($query, $request);
    
        $teams = $query->latest()->paginate($request->per_page ?? 10);
    
        return $this->sendResponse($teams, "Team members retrieved successfully", 200, function ($items) {
            return TeamMemberResource::collection($items);
        });
    }
}
