<?php
/* Konfiguration */

/** 
 * Der  Default Data Set Name (Graph URI) (vgl. http://aifb-ls3-vm2.aifb.kit.edu:8890/sparql)
 */
$graphUri = "http://wissensbasis.sfb125.de/";

/** 
 * Die Abfrage-URL zum Endpoint mit den Platzhaltern {GRAPHURI} für die url-kodierte GraphURI, {QUERY} für das SPARQL-Query und {FORMAT} für das gewünschte Ausgabeformat (application/sparql-results+json oder text/html)
 */
$requestUri = "http://aifb-ls3-vm2.aifb.kit.edu:8890/sparql?default-graph-uri={GRAPHURI}&query={QUERY}&format={FORMAT}&timeout=0&debug=on";

/** 
 * Die URI zum URI-Resolver des semantischen Mediawikis
 */
$uriResolver = "http://surgipedia.sfb125.de/wiki/Special:URIResolver/";
