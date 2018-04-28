<?php
require(__DIR__ . '/../src/PhpQuery.php');

// INITIALIZE IT
// PhpQuery::newDocumentHTML($markup);
// PhpQuery::newDocumentXML();
// PhpQuery::newDocumentFileXHTML('test.html');
// PhpQuery::newDocumentFilePHP('test.php');
// PhpQuery::newDocument('test.xml', 'application/rss+xml');
// this one defaults to text/html in utf8
$doc = PhpQuery::newDocument('<div/>');

// FILL IT
// array syntax works like ->find() here
$doc['div']->append('<ul></ul>');
// array set changes inner html
$doc['div ul'] = '<li>1</li> <li>2</li> <li>3</li>';

// MANIPULATE IT
$li = null;
// almost everything can be a chain
$doc['ul > li']
	->addClass('my-new-class')
	->filter(':last')
		->addClass('last-li')
// save it anywhere in the chain
		->toReference($li);

// SELECT DOCUMENT
// pq(); is using selected document as default
PhpQuery::selectDocument($doc);
// documents are selected when created or by above method
// query all unordered lists in last selected document
$ul = pq('ul')->insertAfter('div');

// ITERATE IT
// all direct LIs from $ul
foreach($ul['> li'] as $li) {
	// iteration returns PLAIN dom nodes, NOT PhpQuery objects
	$tagName = $li->tagName;
	$childNodes = $li->childNodes;
	// so you NEED to wrap it within PhpQuery, using pq();
	pq($li)->addClass('my-second-new-class');
}

// PRINT OUTPUT
// 1st way
print PhpQuery::getDocument($doc->getDocumentID());
// 2nd way
print PhpQuery::getDocument(pq('div')->getDocumentID());
// 3rd way
print pq('div')->getDocument();
// 4th way
print $doc->htmlOuter();
// 5th way
print $doc;
// another...
print $doc['ul'];