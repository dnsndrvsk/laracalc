<?php

namespace App\Http\Controllers\Front;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\UploadedFile;
use App\Models\ReviewsImages;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Image;

class ReviewsImagesApiController extends BaseController
{
//    public function store(Request $request){
//        $review = ReviewsImages::create($request->all());
//        $output = print_r($request->all(), true);
//        file_put_contents('file.txt', $output);
//        return response()->json($review, 201);
//    }

    public function store(Request $request)
    {
        //$filename = $request->file->getClientOriginalName();
        $filePath = '/tmp/';

        $hashedName = hash_file('md5', $request->file->path());
        $timestamp = time();

        $newFilename = $hashedName . $timestamp . '.' . $request->file->getClientOriginalExtension();


        Storage::disk('uploads_images')->put($filePath.$newFilename, file_get_contents($request->file));

        $file = new ReviewsImages();
        $file->path = $newFilename;
        $file->save();

        return response()->json($file, 201);
    }
}
