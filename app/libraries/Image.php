<?php

namespace Libraries;

class Image
{
    public function resize($file, $w, $h, $crop = false)
    {
        $info = pathinfo($file);
        $newpath = $info['dirname'] . '/' . $info['filename'] . "-{$w}x{$h}." . $info['extension'];
        
        if (file_exists($newpath)) { return $newpath; }
        
        list($width, $height) = getimagesize($file);
        $r = $width / $height;
        if ($crop) {
            if ($width > $height) {
                $width = ceil($width-($width*abs($r-$w/$h)));
            } else {
                $height = ceil($height-($height*abs($r-$w/$h)));
            }
            $newwidth = $w;
            $newheight = $h;
        } else {
            if ($w / $h > $r) {
                $newwidth = $h*$r;
                $newheight = $h;
            } else {
                $newheight = $w/$r;
                $newwidth = $w;
            }
        }
        $type = exif_imagetype($file);
        switch ($type) {
            case IMAGETYPE_JPEG:
                $src = imagecreatefromjpeg($file);
                break;
            case IMAGETYPE_PNG:
                $src = imagecreatefrompng($file);
                break;
            case IMAGETYPE_GIF:
                $src = imagecreatefromgif($file);
                break;
        }
        $dst = imagecreatetruecolor($newwidth, $newheight);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
        
        imagejpeg($dst, $newpath);
        
        return $newpath;
    }
}