<?php

class Userprofile extends Controller{
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
      $this->view->js=array('userprofile/js/default.js');
  }
    function index(){
        //echo 'INSIDE INDEX INDEX';
        $this->view->getuserprofile=$this->model->getuserprofile();      
      $this->view->checkpendingapproval=$this->model->checkpendingapproval();
      $this->view->sumthcheckedpaymentpending=$this->model->sumthcheckedpaymentpending();
      $this->view->checkpaymentstatus=$this->model->checkpaymentstatus();
      $this->view->getrentinfo=$this->model->getrentinfo();
      $this->view->alldeposit=$this->model->alldeposit();
      $this->view->monthtrn=$this->model->monthtrn();
      $this->view->alltransactions=$this->model->alltransactions();
      $this->view->transactionaccumulation=$this->model->transactionaccumulation();
      $this->view->checkclientplan=$this->model->checkclientplan();
      $this->view->getperiod=$this->model->getperiod();
      $this->view->render('userprofile/index');
        
    }
    function details(){
        $this->view->render('userprofile/index');
    }
}
