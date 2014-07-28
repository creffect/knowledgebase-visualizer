<!DOCTYPE html>
<html xmlns:foaf="http://xmlns.com/foaf/0.1/" xmlns:dc="http://purl.org/dc/elements/1.1/">
<head>
<meta charset='utf-8'> 
<link href='css/bootstrap-responsive.min.css' rel='stylesheet' type='text/css' />
<link href='css/bootstrap.min.css' rel='stylesheet' type='text/css' />
<link href='css/hilfe.css' rel='stylesheet' type='text/css' />
</head>
<body>

<div class="container">
<br />
<h1>Hilfe</h1>

<br />
<h2>nodeQuery</h2>

<p>Folgende Variablen werden für Knoten unterstützt:</p>

<table>
 <thead><th>Variable</th><th>Beschreibung</th><th>Werte</th></thead>
 <tbody>
 <tr><td>nodeuri</td><td>Die URI des Knotens</td><td>String</td></tr>
 <tr><td>nodetitle</td><td>Angezeigter Knoten-Name</td><td>String</td></tr>
 <tr><td>shape</td><td>Angezeigte geometrische Form</td><td>rect,circle,ellipse</td></tr>
 <tr><td>color</td><td>Angezeigte Farbe</td><td>Hexadezimale Farbangabe, z.B. #00ff00</td></tr>
 <tr><td>size</td><td>Angezeigte Größe</td><td>Integer (in Pixeln, Standard: 10)</td></tr>
 <tr><td>priority</td><td>Da gleiche Knoten (URIs) mehrfach selektiert werden können, und somit unterschiedliche Stylinganweisungen gelten können, gilt immer die Stylinganweisung mit der höchsten Priorität.</td><td>Integer</td></tr>
 </tr>
 </tbody>
</table>

<h3>Beispiel</h3>
<pre>
PREFIX surgi:<?php echo htmlentities("<http://surgipedia.sfb125.de/wiki/Special:URIResolver/>"); ?>
SELECT ((?firstLevelNode)) as ?nodetitle (?firstLevelNode) as ?nodeuri
(if(?type=surgi:Category-3ASFB_participant,"rect","circle")) as ?shape
(if(?type=surgi:Category-3ASFB_participant,"#ff0000","#0000ff")) as
?color WHERE {
   ?firstLevelNode ?firstLink ?target .
   ?firstLevelNode rdf:type ?type
   FILTER ((?type = surgi:Category-3ASFB_participant OR ?type =<?php echo htmlentities("<http://semantic-mediawiki.org/swivt/1.0#Subject>"); ?>) AND
(?target=surgi:A01 OR ?firstLevelNode=surgi:A01))
} 
</pre>
<br />
<h2>linkQuery</h2>

<p>Folgende Variablen werden für Links unterstützt:</p>

<table>
 <thead><th>Variable</th><th>Beschreibung</th><th>Werte</th></thead>
 <tbody>
 <tr><td>source</td><td>Die URI des Startknotens</td><td>String</td></tr>
 <tr><td>target</td><td>Die URI des Zielknotens</td><td>String</td></tr>
 <tr><td>linkuri</td><td>Die URI, die die Verbindungsart beschreibt</td><td>String</td></tr>
 <tr><td>linktitle</td><td>Angezeigter Verbindungsname</td><td>String</td></tr>
 </tr>
 </tbody>
</table>

<h3>Beispiel</h3>
<pre>
PREFIX surgi:<?php echo htmlentities("<http://surgipedia.sfb125.de/wiki/Special:URIResolver/>"); ?>
SELECT ((?firstLevelNode)) as ?source (?target) as ?target (?link) as
?linkuri (?link) as ?linktitle {
   ?firstLevelNode ?link $target .
   FILTER (?target = surgi:A01)
}
</pre>
</div>


</body>
</html>