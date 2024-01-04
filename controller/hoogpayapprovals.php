<?php

class Hoogpayapprovals extends Controller{
    function __construct()
            {
               parent::__construct();
               Session::init();
        		$this->view->js=array('hoogpayapprovals/js/default.js');        		
                $logged=Session::get('superuser');
                if (empty($logged))
                {
                    Session::destroy();
                    header('location: '. URL . 'payslogin');
                    exit;
                }

     }
    function index(){
    	$this->view->getpayments=$this->model->getpayments();
        $this->view->render('hoogpayapprovals/index');
    }
    public function approve()
    {
        $data=array();
        $data['orderno']=$_POST['orderno'];
        $this->model->approve($data);
    }
   
}