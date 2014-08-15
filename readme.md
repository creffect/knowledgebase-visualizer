# Short Summary #

Based on VisualRDF (http://graves.cl/visualRDF/), this tool allows to visualize RDF-data delivered from a SPARQL-Endpoint as a netzwork-graph. It is possible, to filter nodes and links via and their apperance (color, shape, size) via two seperate SPARQL-queries completely customizable.

# Installation Guide #

There is no database required to install this script, just a PHP environement (tested on an apache server, PHP 5.3). You need to copy the files to your server and adjust the settings in **config.php** to your needs.

$graphURI - the Default Data Set Name
$requestUri - Uri to the SPARQL Endpoint, you are using
$uriResolver - Uri to the Mediawiki URI Resolver

