<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exceptions\CustomException;

class BaseController extends Controller
{
    protected function sendResponse($data, $message = null, $status = 200, $callback = null)
    {
        $responseData = [
            'success' => true,
            'data' => [],
            'pagination' => null,
            'message' => $message,
        ];
    
        if ($data instanceof \Illuminate\Pagination\LengthAwarePaginator) {
            // If the data is paginated, extract the items and pagination details
            $responseData['data'] = $callback ? $callback($data->items()) : $data->items();
            $responseData['pagination'] = [
                'current_page' => $data->currentPage(),
                'per_page' => $data->perPage(),
                'total' => $data->total(),
                'next_page_url' => $data->nextPageUrl(),
                'prev_page_url' => $data->previousPageUrl(),
            ];
        } else {
            // If the data is not paginated, use it directly
            $responseData['data'] = $callback ? $callback($data) : $data;
        }
        
        return response()->json($responseData, $status);
    }

    protected function sendError($message, $status = 400)
    {
        return response()->json(['success' => false, 'message' => $message, 'error' => $message], $status?:500);
    }
}
