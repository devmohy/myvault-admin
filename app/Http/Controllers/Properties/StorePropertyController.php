<?php

namespace App\Http\Controllers\Properties;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Traits\FileUpload;
use Illuminate\Http\Request;

class StorePropertyController extends Controller
{
    use FileUpload;
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        request()->validate([
            'name' => ['required','string'],
            'description' => ['required','string'],
            'location' => ['required','string'],
            'slot_price' => ['required','numeric'],
            'available_slot' => ['required','numeric'],
            'member_slot_price' => ['required','numeric'],
            'investment_type' => ['required','string'],
            'brochure_link' => ['required','string'],
        ]);

        if($request->hasFile('image')){
            $image = $this->upload($request, 'image', 'event');
            
        }

        $property = Property::create([
            'name' => request('name'),
            'description' => request('description'),
            'location' => request('location'),
            'slot_price' => request('slot_price'),
            'total_slots' => request('slot_price'),
            'available_slot' => request('available_slot'),
            'member_slot_price' => request('member_slot_price'),
            'investment_type' => request('investment_type'),
            'brochure_link' => request('brochure_link'),
            'status' => 'active',
        ]);

        $property->update(['image_path' => $image]);
        return $property;
    }
}
