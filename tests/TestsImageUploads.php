<?php

/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 4/25/16
 * Time: 4:14 PM
 */
trait TestsImageUploads
{
    protected function prepareFileUpload($path, $name = null)
    {
        $copyPath = $this->getCopyPath($path);
        $this->assertFileExists($path);
        copy($path, $copyPath);
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $copyPath);
        return new \Illuminate\Http\UploadedFile($copyPath, $name ? $name : 'test-upload.png', $mime, 15004, null, true);
    }
    protected function getCopyPath($path)
    {
        return preg_replace('/([^\/.]+)(\.[a-zA-Z]+$)/', "$1_copy$2", $path);
    }

}