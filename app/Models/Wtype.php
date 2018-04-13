<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

//use Illuminate\Support\Facades\Storage;
//use Intervention\Image\Facades\Image;

class Wtype extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'wtypes';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['name', 'sash', 'image'];
    // protected $hidden = ['created_at', 'updated_at'];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public static function boot()
    {
        static::deleting(function ($obj) {
            if (isset($obj->image)) {
                \Storage::disk('uploads')->delete($obj->image);
            }
        });
    }

    function getMIMETYPE($base64string)
    {
        preg_match("/^data:image\/(.*);base64/", $base64string, $match);
        return $match[1];
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function get_windows()
    {
        return $this->hasMany('App\Models\Windows', 'wtypes');
    }
    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    public function setImageAttribute($value)
    {
        $attribute_name = "image";
        $disk = 'uploads';
        $destination_path = "images/wtypes";

        // if the image was erased
        if ($value == null) {
            // delete the image from disk
            \Storage::disk($disk)->delete($this->{$attribute_name});

            // set null in the database column
            $this->attributes[$attribute_name] = null;
        }

        // if a base64 was sent, store it in the db
        if (starts_with($value, 'data:image')) {

            // 0. Make the image
            $image = \Image::make($value);
            // 1. Generate a filename.
            $filename = md5($value . time()) . '.' . $this->getMIMETYPE($value);

            $image_path = $destination_path . '/' . $filename;

            // 2. Store the image on disk.
            \Storage::disk($disk)->put($image_path, $image->stream());
            // 3. Save the path to the database
            $this->attributes[$attribute_name] = $image_path;
        }
    }


}