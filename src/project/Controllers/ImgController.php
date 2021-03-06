<?php
/**
 * Created by PhpStorm.
 * User: refik
 * Date: 01/07/16
 * Time: 10:19
 */

namespace Project\Controllers;


use Illuminate\Support\Facades\Input;
use Project\Helpers\Image;

class ImgController extends Controller
{

    public function getIndex ()
    {
        return response('204 No Content', 204);
    }

    public function postIndex ()
    {
        //return 'HEDE ?'."\n";

        // Authorize request

        // Uploaded file
        $file = Input::file('file');

        // Validate uploaded file
        if (!$file || !$file->isValid()) {
            //throw new Exception("Dosya hatalı", 1);
            return response('Dosya hatalı', 400);
        }

        // File path query string
        $path = Input::get('path');

        // Manipulate image file (Imagick):
        //    set dpi to 72
        //    scale to fit maximum dimensions
        //    fix orientation
        $img = new Image($file->getPathname());

        // Save manipulated file
        // Return file info:
        //    dimensions
        //    path
        //..
        $img->writeJpeg(rtrim($path) . '/' . time() . '.jpg');

        return [
            'uploadpath' => $path,
            'pathname'   => $file->getPathname(),
            'clientname' => $file->getClientOriginalName(),
        ];
    }

    public function postEcho ()
    {
        return Input::all();
    }

}