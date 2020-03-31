<?php

namespace App\Services;

use Image;

class ImageResize
{

    public static function crop($img_name, $x, $y, $type = 'fit')
    {
        $full_path = storage_path('app/public/'.$img_name);
        $full_thumb_path = storage_path('app/public/thumbs/'.$img_name);
        $thumb = Image::make($full_path);
        //Kvadrat
        if ($type == 'fit')
            self::fit($thumb, $x, $y, $full_thumb_path);
        else
            self::resize($thumb, $x, $y, $full_thumb_path);
    }

    private static function fit($thumb, $x, $y, $full_thumb_path)
    {
        //Kvadrat proporsiya
        $thumb->fit($x, $y, function($constraint){
            $constraint->aspectRatio();
        })->save($full_thumb_path);
    }

    private static function resize($thumb, $x, $y, $full_thumb_path)
    {
        //Proporsiya
        $thumb->resize($x, $y, function($constraint) {
            $constraint->aspectRatio();
        })->save($full_thumb_path);
    }

}
