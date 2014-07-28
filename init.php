<?php

/* Einfache Überprüfung der gesendeten Daten */
$nodeQuery = "";
if (isset($_POST['nodeQuery']))
	$nodeQuery = $_POST['nodeQuery'];
if (isset($_GET['nodeQuery']))
	$nodeQuery = $_GET['nodeQuery'];
$linkQuery = "";

if (isset($_POST['linkQuery']))
	$linkQuery = $_POST['linkQuery'];
if (isset($_GET['linkQuery']))
	$linkQuery = $_GET['linkQuery'];

$dataSent = false;
if ($nodeQuery) {
	$dataSent = true;
}