<?php

class File
{
    /**
     *
     * Hoa
     * Created at 27-04-2021 09h00
     * delete file (image)
     *
     */
    static function deleteImage($path)
    {
        if (file_exists($path)) {
            unlink($path);
            echo 'File ' . $path . ' has been deleted';
        } else {
            echo 'Could not delete ' . $path . ', file does not exist';
        }
    }
}