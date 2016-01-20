## What MultiDocumentSupport is
  * support for working on several documents in same time
  * easy importing of nodes from one document to another
  * pointing document thought
    * phpQuery object
    * [DOMNode](http://www.php.net/manual/en/class.domnode.php) object
    * [DOMDocument](http://www.php.net/manual/en/class.domdocument.php) object
    * internal document ID
  * last created (or selected) document is assumed to be default in pq();
## What MultiDocumentSupport is NOT
  * it's **not possible** to fetch nodes from several document in one query
  * it's **not possible** to operate on nodes from several document in one phpQuery object

## Example
```
// first three documents are wrapped inside phpQuery
$doc1 = phpQuery::newDocumentFile('my-file.html');
$doc2 = phpQuery::newDocumentFile('my-file.html');
$doc3 = phpQuery::newDocumentFile('my-other-file.html');
// $doc4 is plain DOMDocument
$doc4 = new DOMDocument;
$doc4->loadHTMLFile('my-file.html');
// find first UL list in $doc1
$doc1->find('ul:first')
  // append all LIs from $doc2 (node import)
  ->append( $doc2->find('li') )
  // append UL (with new LIs) into $doc3 BODY (node import)
  ->appendTo( $doc3->find('body') );
// this will find all LIs from $doc3
// thats because it was created as last one
pq('li');
// this will find all LIs inside first UL in $doc2 (context query)
pq('li', $doc2->find('ul:first')->get());
// this will find all LIs in whole $doc2 (not a context query)
pq('li', $doc2->find('ul:first')->getDocumentID());
// this will transparently load $doc4 into phpQuery::$documents
// and then all LIs will be found
// TODO this example must be verified
pq('li', $doc4); 
```
## Static Methods
  * phpQuery::**newDocument**($html) Creates new document from markup
  * phpQuery::**newDocumentFile**($file) Creates new document from file
  * phpQuery::**getDocument**($id = null) Returns phpQueryObject containing document with id $id or  default document (last created/selected)
  * phpQuery::**selectDocument**($id) Sets default document to $id
  * phpQuery::**unloadDocuments**($id = null) Unloades all or specified document from memory
  * phpQuery::**getDocumentID**($source) Returns $source's document ID
  * phpQuery::**getDOMDocument**($source) Get DOMDocument object related to $source
## Object Methods
  * $pq->**getDocument**() Returns object with stack set to document root
  * $pq->**getDocumentID**() Get object's Document ID
  * $pq->**getDocumentIDRef**(&$documentID) Saves object's DocumentID to $var by reference
  * $pq->**unloadDocument**() Unloads whole document from memory