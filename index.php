<?php
//use auto loader later
require "libs/Bootstrap.php";
require "libs/ControllerBase.php";
require "libs/Model.php";
require "libs/View.php";
//Library requre
require 'libs/Database.php';
require 'libs/Session.php';
//configuration require
require "config/paths.php";
require "config/database.php";


$app=new Bootstrap();
?>
