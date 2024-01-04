<?php

class user extends Controller{
    function __construct()
    {
        parent::__construct();
        Session::init();
        $role=Session::get('role');
        $logged=Session::get('loggedIn');
        if ($logged==false || $role != 'owner')
        {
            Session::destroy();
            header('location:'. URL .'login');
            exit;
        }
    }
    function index(){

        $this->view->render('user/index');
    }

}