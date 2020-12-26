<?php

namespace App\Utils;

use App\Utils\Interfaces\UploaderInterface;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Filesystem\Filesystem;
class LocalUploader implements UploaderInterface
{
    private $targetDirectory;

    public $file;

    public function __construct($targetDirectory)
    {
        $this->targetDirectory=$targetDirectory;
    }

    public function upload($file)
    {
        $video_number = random_int(1,10000000);
        $filename = $video_number.'.'.'mp4';
        $dir = $this->getTargetDirectory();

        try{
            $file->move($this->getTargetDirectory(), $filename);
        } catch (FileException $e){
            //
        }

        $orig_file_name = $this->clear(pathinfo($file->getClientOrignalName(),PATHINFO_FILENAME));

        return [$filename, $orig_file_name];
    }

    private function getTargetDirectory(){
        return $this->targetDirectory;
    }

    private function clear($string)
    {
        $string = preg_replace('/[^A-Za-z0-9- ]+/','',$string);
        return $string;
    }

    public function delete($path)
    {
        $fileSystem = new Filesystem();
        try{
            $fileSystem->remove('.'.$path);
        } catch (IOExceptionInterface $exception){
            echo $exception->getPath();
        }
        return true;
    }
}