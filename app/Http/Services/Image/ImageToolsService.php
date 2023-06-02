<?php


namespace App\Http\Services\Image;


class ImageToolsService
{

    protected $image;

    protected $exclusiveDirectory;

    protected $imageDirectory;

    protected $imageName;

    protected $imageFormat;

    protected $finalImageDirectory;

    protected $finalImageName;




    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getExclusiveDirectory()
    {
        return  $this->exclusiveDirectory;
    }

    public function setExclusiveDirectory($exclusiveDirectory)
    {
        $this->exclusiveDirectory =  trim($exclusiveDirectory, '/\\');
    }


    public function getImageDirectory()
    {
        return  $this->imageDirectory;
    }


    public function setImageDirectory($imageDirectory)
    {
        $this->imageDirectory = trim($imageDirectory, '/\\');
    }

    public function getImageName()
    {
        return  $this->imageDirectory;
    }

    public function setImageName($imageName)
    {
        $this->imageName = $imageName;
    }

    public function setCurrentImageName()
    {
        return  !empty($this->image) ? $this->setImageName(pathinfo($this->image->getClientOriginalName(), PATHINFO_FILENAME)) : false;
    }


    public function getImageFormat()
    {
        return $this->imageFormat;
    }


    public function setImageFormat($imageFormat)
    {
        $this->image = $imageFormat;
    }


    public function getFinalImageDirectory()
    {
        return $this->finalImageDirectory;
    }


    public function setFinalImageDirectory($finalImageDirectory)
    {
        $this->image = $finalImageDirectory;
    }



    public function setFinalImageName($finalImageName)
    {
        $this->image = $finalImageName;
    }


    public function getFinalImageName()
    {
        return  $this->finalImageName;
    }
}
