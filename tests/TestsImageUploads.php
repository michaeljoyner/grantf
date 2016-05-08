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
        $this->assertFileExists($path);
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $path);
        return new \Symfony\Component\HttpFoundation\File\UploadedFile ($path, $name ? $name : 'test-upload.png', $mime, 15004, null, true);
    }
}