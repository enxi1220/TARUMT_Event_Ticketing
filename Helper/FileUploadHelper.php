<?php

/**
 * Description of FileUploadHelper
 *
 * @author enxil
 */

class FileUploadHelper
{

    public static function UploadImage($file, $directory)
    {
        $fileName = uniqid() . "_" . basename($file['name']); // generate new filename
        $targetPath = $_SERVER['DOCUMENT_ROOT'] . $directory . $fileName; // specify store location
        $posterTemp = $file['tmp_name'];
        move_uploaded_file($posterTemp, $targetPath); // move the uploaded file to the specified location

        if (!is_uploaded_file($file['tmp_name'])) {
            throw new Exception("Image failed to upload.");
        }
        return $fileName;
    }
}
