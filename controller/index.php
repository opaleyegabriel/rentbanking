<?php

class Index extends Controller{
    function __construct()
    {
       parent::__construct();
       $this->view->js=array('index/js/default.js');

    }
    function index(){
        //echo 'INSIDE INDEX INDEX';
        $this->view->render('index/index');
        echo date('d-m-Y H:i:s', mktime(date('H'),date('i'),date('s'), date('m'),date('d')+1,date('Y')));
       // $msg='I want this display as a test to the app';
    }
    function details(){
        $this->view->render('index/index');
    }
    public function mobileno(){
      $data=array();
      $data['mobileno']=$_POST['mobileno'];
      //echo "<pre>";
      //print_r($data);
      $this->model->mobileno($data);
    }
    public function login(){
      $data=array();
      $data['mobileno']=$_POST['mobileno'];
      $data['password']=$_POST['password'];
      //echo "<pre>";
      //print_r($data);
      $this->model->login($data);
    }
}
