<?php

namespace Models;
use Exceptions\UploadException;

class Media extends BaseModel
{
    const MAX_MEDIA_SIZE = 10000000;
    const MAX_THUMB_SIZE = 2000000;
    
    public function post()
    {
        
    }
    
    public function upload($cat, $slug, $files)
    {
        if (isset($files['media'])) {
            
            $file = $files['media'];
            
            if ($file['error'] !== UPLOAD_ERR_OK) { 
                throw new UploadException($file['error']);
            }
                        
            if ($file['size'] > self::MAX_MEDIA_SIZE) { 
                throw new UploadException(UploadException::SET_FILE_SIZE);
            }
            
            $target = PUBLIC_PATH . "/images/$cat/$slug/{$file['name']}";
            $info   = pathinfo($target);
            
            // create directory names
            if (!file_exists($info['dirname']) && !mkdir($info['dirname'], 0777, true) ) {
                throw new UploadException(UploadException::NO_DIRECTORY);                
            }
            
            if (!move_uploaded_file($file['tmp_name'], $target)) {
                throw new UploadException(UploadException::MOVE_FAILED);
            }
            
            // generate thumbnail
            image($target, 100, 100);
        }
        
        if (isset($files['thumbnail'])) {
            
        }
    }
}
