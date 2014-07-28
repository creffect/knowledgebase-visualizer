<?php



/** 
 * Führt eine Sparql-Abfrage durch und gibt das Ergebnis als JSON zurück
 */
function sparqlQuery($query) {
	global $graphUri, $requestUri;
	
	// Anfrage zusammenbasteln
	$curRequestURI = str_replace(array('{GRAPHURI}', '{QUERY}', '{FORMAT}'), array(urlencode($graphUri), urlencode($query), urlencode("application/sparql-results+json")), $requestUri);
	
	// JSON abrufen
	$json = file_get_contents($curRequestURI);
	$json = json_decode($json, true);
	if ($json == NULL) {
		die ("Fehler bei der Abfrage der JSON-Daten: URL: ".$curRequestURI);
	}
	
	return $json;
}

/** 
 * Führt eine Sparql-Abfrage durch und gibt das Ergebnis als HTML-Tabelle zurück
 */
function sparqlQueryTable($query) {
	global $graphUri, $requestUri;
	
	// Anfrage zusammenbasteln
	$curRequestURI = str_replace(array('{GRAPHURI}', '{QUERY}', '{FORMAT}'), array(urlencode($graphUri), urlencode($query), urlencode("text/html")), $requestUri);
	
	// JSON abrufen
	$result = file_get_contents($curRequestURI);
	
	return $result;
}

/** 
 * Erstellt einen neuen Knoten
 */ 
function createNode($uri, $name, $shape, $color) {
	global $results, $nodes, $c;
	
	// Existiert Knoten schon?
	if (isset($nodes[$uri])) return $nodes[$uri];
	
	// Uri registieren und ID zuweisen
	$nodes[$uri] = $c;
	$c++;
	
	// Knoten abspeichern
	$results['nodes'][] = array("name" => $name, "uri" => $uri, "type" => $shape, "color" => $color);
	
	return $nodes[$uri];
}

/** 
 * Erstellt eine neue Verbindung
 */ 
function createLink($sourceUri, $targetUri, $name, $value) {
	global $results, $nodes;

	// Ignorieren, falls Startknoten nicht existiert 
	if (!isset($nodes[$sourceUri]) || $sourceUri === NULL) {
		return;
		//throw new Exception ("Verknüpfung zu nicht existierendem Source-Knoten: ".$sourceUri);
	}
	// Ignorieren, falls Zielknoten nicht existiert 
	if (!isset($nodes[$targetUri]) ||!$nodes[$targetUri] === NULL) {
		return;
		//throw new Exception ("Verknüpfung zu nicht existierendem Target-Knoten: ".$targetUri);
	}
	// Link abspeichern
	$results['links'][] = array("source" => $nodes[$sourceUri], "target" => $nodes[$targetUri], "name" => $name, "value" => $value);
}


/** 
 * Wandelt die URI in einen lesbaren Titel um
 */
function getTitleByUri($uri) {
	global $uriResolver;
	
	if (substr($uri, 0, strlen($uriResolver)) == $uriResolver) {
		$title = substr($uri, strlen($uriResolver));
		$title = urldecode($title);
		$title = str_replace(array('_', "-2D", "-3A"), array(' ', "-", ":"), $title);
		return $title;
	}
	return $uri;
}

/**
 * Gibt einen Permalink zur aktuellen Abfrage zurück
 */
function getPermalink() {
	global $nodeQuery, $linkQuery;
	
	return "?nodeQuery=".urlencode($nodeQuery)."&linkQuery=".urlencode($linkQuery);
}

