<?php
namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use InvalidArgumentException;
use Throwable;

trait FileUpload {

    /**
     * @param Request $request
     * @return $this|false|string
     */
    public function upload(Request $request, $fieldname = 'image', $directory = 'images') {

        if( $request->hasFile( $fieldname ) ) {
            if (!$request->file($fieldname)->isValid()) {
                throw new InvalidArgumentException("Invalid $fieldname");
            }
            try{
                $file = $request->file($fieldname)->store($directory, 'public');
            } catch(Throwable $e){
                logger("NO  $fieldname was uploaded.");
                throw new InvalidArgumentException($e->getMessage());
            }
        }
        if(!Storage::disk('public')->exists($file)){
            throw new InvalidArgumentException("$fieldname fail to upload");
        }
        return $file;
    }
}