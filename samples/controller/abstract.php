<?php

require_once '../bootstrap.php';

class SampleController extends PAF_Controller_Abstract
{
    public function __construct()
    {
        parent::__construct();
        $this->_view = new PAF_View_Template();
    }
    
    public function index()
    {
        $this->view->title = 'Index';
    }
    
    public function time()
    {
        $this->_view->time = date('H:i:s');
        $this->_view->title = 'Time';
    }
    
    public function date()
    {
        $this->_view->date = date('Y-m-d');
        $this->_view->title = 'Date';
    }
}

$action = isset($_GET['action']) ? $_GET['action'] : 'index';

$controller = new SampleController();
$controller->view->template = $action . '.phtml';
$controller->doAction($action);

$controller->view->render();
