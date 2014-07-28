<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Konfig laden
require_once('config.php');

// Funktionen einbinden
require_once('functions.php');

// Skript initialisieren
require_once('init.php');

  
$c = 0;
$nodes = array();
$results = array();
$literals = array();

$nodesJSON = sparqlQuery($nodeQuery);
if ($linkQuery) {
	$linksJSON = sparqlQuery($linkQuery);
}

// Alle Knoten erzeugen
foreach($nodesJSON['results']['bindings'] as $binding) {
	createNode($binding['nodeuri']['value'], getTitleByUri($binding['nodetitle']['value']), $binding['shape']['value'], $binding['color']['value']);
}
// Alle Links erzeugen

if ($linkQuery) {
	
	foreach($linksJSON['results']['bindings'] as $binding) {
		createLink($binding['source']['value'], $binding['target']['value'], getTitleByUri($binding['linktitle']['value']), 10);
	}
}

$results['literals'] = $literals;

echo json_encode($results);
