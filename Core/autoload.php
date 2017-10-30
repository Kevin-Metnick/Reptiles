<?php
require 'Config.php';
spl_autoload_register(function($name){
	// echo $name;
	// 
	require_once ROOT.'./Core/'.$name.'.php';
	// die;
});