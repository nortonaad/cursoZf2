<?php
namespace Developer\Model;

use Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Paginator\Paginator;

class ListDirectory
{
    protected $directory;
    
    public function __construct($directory)
    {
        $this->directory = $directory;
    }

    public function FechAll($paginated=false)
    {
        $files = array();

        $dir = opendir($this->directory);
        while ($file = readdir($dir))
        {
        	if (!is_dir($file))
        	{
        		$files[] = pathinfo($file, PATHINFO_FILENAME);
        	}
        }
        
    	if ($paginated) {
    	    $paginatorAdapter = new ArrayAdapter($files);
     		$paginator = new Paginator($paginatorAdapter);
     		return $paginator;
     	}

    	return $files;
    }

}