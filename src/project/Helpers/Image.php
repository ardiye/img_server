<?php
/**
 * Created by PhpStorm.
 * User: refik
 * Date: 01/07/16
 * Time: 15:09
 */

namespace Project\Helpers;

use Imagick;

class Image
{
    private $img;
    private $basePath = '/tmp';


    public function __construct ($path)
    {
        $this->basePath = rtrim(env('IMG_BASEPATH', $this->basePath), '/');

        $this->img = new Imagick;
        $this->img->readImage($path);

        $this->manipulateResolution();
        $this->manipulateDimensions();
        $this->manipulateOrientation();
    }


    protected function manipulateResolution ()
    {
        $this->img->setImageResolution(72, 72);
        $this->img->resampleImage(72, 72, Imagick::FILTER_UNDEFINED, 0);
    }


    protected function manipulateOrientation ()
    {
        $orientation = $this->img->getImageOrientation();

        switch ($orientation) {
            case Imagick::ORIENTATION_BOTTOMRIGHT:
                $this->img->rotateImage("#000", 180); // rotate 180 degrees
                break;

            case Imagick::ORIENTATION_RIGHTTOP:
                $this->img->rotateImage("#000", 90); // rotate 90 degrees CW
                break;

            case Imagick::ORIENTATION_LEFTBOTTOM:
                $this->img->rotateImage("#000", -90); // rotate 90 degrees CCW
                break;
        }

        // Now that it's auto-rotated, make sure the EXIF data is correct in case the EXIF gets saved with the image!
        $this->img->setImageOrientation(Imagick::ORIENTATION_TOPLEFT);
    }

    protected function manipulateDimensions ()
    {
        $this->img->resizeImage(
            600,    // w
            600,    // h
            Imagick::FILTER_CATROM, // filter
            1,      // blur ( sharp < 1 (don't change) < blurry )
            true    // bestfit
        );
    }

    public function writeJpeg ($path)
    {
        $path = $this->basePath . '/' . ltrim($path, '/');

        $this->img->setImageFormat('jpeg');
        $this->img->setImageCompressionQuality(90);
        $this->img->writeImage($path);
    }


}
