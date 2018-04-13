<?php

namespace App\Http\Controllers\Front;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Reviews;
use App\Models\ReviewsImages;

class ReviewsApiController extends BaseController
{
    public function store(Request $request)
    {
        $files = $request->get('files');
        $review = Reviews::create($request->all()); // Создали и получили ID отзыва
        $filePath = '/tmp/';
        $images_ids = [];
        foreach ($files as $file) { //Массив ид картинок
            $f = json_decode($file);
            array_push($images_ids, $f->id); // Собираем айдишники

            \Storage::disk('uploads_images')->move($filePath . $f->path, $f->path); // Move from tmp folder
        }

        ReviewsImages::whereIn('id', $images_ids)
            ->update(['review_id' => $review->id]); // Всем картинкам присваиваем review_id


        return $images_ids;
    }
}
