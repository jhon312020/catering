<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function pr($data = array()){
	echo "<pre>";
	print_r($data);
	echo "</pre>";
}

function debug($data = array()){
	echo "<pre>";
	var_dump($data);
	echo "</pre>";
}