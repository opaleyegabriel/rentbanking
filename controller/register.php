<?php

class Register extends Controller{
    function __construct()
    {
       parent::__construct();
       $this->view->js=array('register/js/default.js');

    }
    function index(){
        //echo 'INSIDE INDEX INDEX';
        $this->view->render('register/index');
    }
    function details(){
        $this->view->render('register/index');
    }
    public function mobileno(){
      $data=array();
      $data['mobileno']=$_POST['mobileno'];
      //echo "<pre>";
      //print_r($data);
      $this->model->mobileno($data);
    }
  public function register(){
    $data=array();
    $data['clientname']=$_POST['clientname'];
    $data['mobileno']=$_POST['mobileno'];
    $data['password']=$_POST['password'];
    $data['confirmpassword']=$_POST['confirmpassword'];
    $data['agentmobileno']=$_POST['agentmobileno']; 

    //echo "<pre>";
    //print_r($data);
    $this->model->register($data);
  }
}
