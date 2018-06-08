<?php

namespace GimsSocial;

interface UploadImagesInterface
{
    public function __construct($file);
    public function uploadImage();
}

class UploadImages implements UploadImagesInterface
{
    private $name;
    private $trgt_dir;
    private $trgt_file;
    private $permittedTypes;
    private $imageExtension;

    public function __construct($file)
    {
        $this->name = $file['file']['name'];
        $this->trgt_dir = 'upload/';
        $this->trgt_file = $this->trgt_dir.basename($file['file']['name']);
        $this->imageExtension = strrolower(pathinfo($this->trgt_file, PATHINFO_EXTENSION));
        $this->permittedTypes = array('jpeg', 'jpg', 'png', 'gif');
    }

    public function uploadImage()
    {
        if(in_array($this->imageExtension, $permittedTypes))
        {
            //space to query
            move_uploaded_file($file['file']['tmp_name'], $this->trgt_dir.$this->name);
        }
        else
        {
            return false;
        }
    }
}
?>