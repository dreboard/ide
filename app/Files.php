<?php

namespace App\Core;

use App\Core\Database;
use PDO;
use SimpleXMLElement;

/**
 * Class Files
 * @package App\Core
 */
class Files
{
    /* @var Database */
    protected $dir = __DIR__."/../public/files";

    protected $coreFiles = ['file.csv', 'file.html', 'file.txt', 'file.xml'];

    /**
     * @var
     */
    protected $data;

    /**
     * Code constructor.
     */
    public function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function findAll()
    {
        $files = [];
        $dirList = array_diff(scandir($this->dir), ['..', '.']);
        $i = 0;
        foreach ($dirList as $file){
            $files[] = pathinfo($file);
            $files[$i]['ext'] = pathinfo($this->dir.'/'.$file, PATHINFO_EXTENSION);
            $files[$i]['size'] = filesize($this->dir.'/'.$file);
            $files[$i]['atime'] = date("F d Y H:i:s.", fileatime($this->dir.'/'.$file));
            $files[$i]['url'] = "public/files".$file;
            $files[$i]['stat'] = stat($this->dir.'/'.$file);
                $i++;
        }
        return $files;
    }


    /**
     * @param string $code_title
     * @param string $code_block
     * @param string $code_section
     * @return mixed
     */
    public function create(string $name)
    {
        if(!file_exists($this->dir.'/'.$name)){
            $file = fopen($this->dir.'/'.$name, 'r+');
        }
        return 'File created';
    }



    /**
     * @param int $id
     * @return mixed
     */
    public function delete(string $name)
    {
        if(file_exists($this->dir.'/'.$name)){
            unlink($this->dir.'/'.$name);
        }
        return false;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function deleteAll()
    {
        $files = glob($this->dir . '/*');
        foreach($files as $file) {
            if(!in_array(basename($file), $this->coreFiles)){
                $this->delete($this->dir.'/'.$file);
            }
            deleteAll($path);
        }
        if(file_exists($this->dir.'/'.$name)){
            unlink($this->dir.'/'.$name);
        }
        return 'File created';
    }

    /**
     * @param string $name
     * @return array
     */
    public function search(string $name): array
    {

    }

    /**
     * @param int $id
     * @return mixed
     */
    public function loadFile(string $name)
    {
        $file = $this->dir.'/'.$name;
        if(file_exists($file)){
            $type = pathinfo($file, PATHINFO_EXTENSION);
            switch ($type){
                case 'xml':
                    return $this->processXml($file);
                case 'csv':
                    return $this->processCsv($file);
                default:
                    return $this->processText($file);
            }
        }
        return 'No file found';


    }

    public function processXml($file)
    {
        try{
            $sxe = new SimpleXMLElement($file, NULL, TRUE);
            return $sxe->asXML();
        }catch (\Throwable $e){
            echo $e->getMessage();
        }

    }

    public function processCsv($file)
    {

    }

    public function processText($file)
    {

    }

}