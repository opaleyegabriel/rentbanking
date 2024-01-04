<?php

class Newhoogpay extends Controller{
    function __construct()
            {
               parent::__construct();
               Session::init();
                $this->view->js=array('newhoogpay/js/default.js');
               

     }
    function index(){
        //$this->view->myorders=$this->model->getorders();
       $this->view->render('newhoogpay/index');   
    }


    public function paymenttrack(){
         $data=array();      
        $data['mobileno']=$_POST['mobileno'];
        $data['amount']=$_POST['amount'];
        $data['orderno']=$_POST['orderno'];        
        $data['sentfrom']=$_POST['sentfrom'];       
      
    $this->model->paymenttrack($data);
    }
    public function updatepayment(){
       $data=array();      
        $data['mobileno']=$_POST['mobileno'];
    $this->model->updatepayment($data);
    }

    public function check4approval(){
      $data=array();      
        $data['mobileno']=$_POST['mobileno'];        
            
    $this->model->check4approval($data);
    }
  

                          
}