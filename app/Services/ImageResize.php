<?php

namespace App\Services;

use Image;

/**
 * ImageResize class
 */
class ImageResize
{

    /**
     * Resize image as Square(fit) or Rectangle(resize)
     * with this functions
     *
     * @param  mixed $img_name
     * @param  mixed $x
     * @param  mixed $y
     * @param  mixed $type
     * @return void
     */
    public static function crop($img_name, $x, $y, $type = 'fit')
    {
        $full_path = storage_path('app/public/'.$img_name);
        $full_thumb_path = storage_path('app/public/thumbs/'.$img_name);
        $thumb = Image::make($full_path);

        if ($type == 'fit')
            self::fit($thumb, $x, $y, $full_thumb_path);
        else
            self::resize($thumb, $x, $y, $full_thumb_path);
    }

    /**
     * Resize image as Square by params $x, $y
     *
     * @param  mixed $thumb
     * @param  mixed $x
     * @param  mixed $y
     * @param  mixed $full_thumb_path
     * @return void
     */
    private static function fit($thumb, $x, $y, $full_thumb_path)
    {

        $thumb->fit($x, $y, function($constraint){
            $constraint->aspectRatio();
        })->save($full_thumb_path);
    }

    /**
     * Resize image as Rectangle by params $x, $y
     *
     * @param  mixed $thumb
     * @param  mixed $x
     * @param  mixed $y
     * @param  mixed $full_thumb_path
     * @return void
     */
    private static function resize($thumb, $x, $y, $full_thumb_path)
    {

        $thumb->resize($x, $y, function($constraint) {
            $constraint->aspectRatio();
        })->save($full_thumb_path);
    }

}
