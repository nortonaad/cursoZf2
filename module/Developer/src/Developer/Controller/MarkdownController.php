<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Developer for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Developer\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Helper\ViewModel;
use Zend\Config\Reader;
use Developer\Model\ListDirectory;

class MarkdownController extends AbstractActionController
{
    public function indexAction()
    {
        $files = array();
    	$data = $this->params()->fromRoute('filename', 0);
    	if(file_exists(__DIR__."/../../../../../docs/developer\\".$data.".md"))
    		$data = file_get_contents(__DIR__."/../../../../../docs/developer\\".$data.".md");
    	else if($data!==0)
    	{  
            $this->getResponse()->setStatusCode(404);
    	}
    	else
    	{
    	    $data=null;
    	    
    	    $ld = new ListDirectory(__DIR__."/../../../../../docs/developer\\");
    	    $paginator = $ld->FechAll(true);
    	    $paginator->setCurrentPageNumber((int) $this->params()->fromQuery('page', 1));
    	    $paginator->setItemCountPerPage(10);
    	    	
//     	    $dir = opendir(__DIR__."/../../../../../docs/developer\\"); 
//     	    while ($file = readdir($dir)) 
//     	    {
//     	    	if (!is_dir($file))
//     	    	{
//     	    	    $files[] = pathinfo($file, PATHINFO_FILENAME);
//     	    	}
//     	    }    	    
    	}
    	
    	return array('data' => $data, 'paginator' => $paginator);
    }
}
