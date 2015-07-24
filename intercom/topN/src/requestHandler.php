<?php

//A little file to handle the post request from the page and instantiate the class
require_once 'topN.php';

if(isset( $_POST['function'] ) && isset($_POST['n'])) {
	$n = filter_var($_POST['n'], FILTER_SANITIZE_NUMBER_INT);

    if ($_POST['function'] == 'readfileInChunks') {
    	$TopN = new TopN();
		$TopN->readfileInChunks(TRUE, $n);
    }   
}
