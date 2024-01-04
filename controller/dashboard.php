<?php

class Dashboard extends Controller{
    function __construct()
    {
        parent::__construct();
        Session::init();
        $logged=Session::get('loggedIn');
        if ($logged==false)
        {
            Session::destroy();
            header('location: '. URL . 'index');
            exit;
        }
        //print_r($_SESSION);
        $this->view->js=array('dashboard/js/default.js');
    }
    function index(){
      
      $this->view->sumtransactionnotpaid=$this->model->sumtransactionnotpaid();
      $this->view->checkforpayments=$this->model->checkforpayments();
     $this->view->checkclientplan=$this->model->checkclientplan();
      $this->view->getplans=$this->model->getplans();
      $this->view->render('dashboard/index');
    }
    function logout()
    {
        Session::destroy();
        header('location: ../index');
        exit;
    }
    public function saveclientrent(){
      $data=array();
      $data['mobileno']=Session::get("currentnumber");
      $data['targetmonths']=$_POST['targetmonths'];
      $data['monthtopay']=$_POST['monthtopay'];
      $data['benefitno']=$_POST['benefitno'];
      $data['targetamount']=$_POST['targetamount'];
      $data['monthlypayment']=$_POST['monthlypayment'];
      $data['deposit']=$_POST['deposit'];
      Session::set("amount",$_POST['deposit']);
      session::set('fresh',true);
 // $data['pstatus']='I';
     // echo "<pre>";
      //print_r($data);
      $this->model->saveclientrent($data);
      $this->view->render('newhoogpay');

}
}
