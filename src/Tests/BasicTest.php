<?php
namespace PhpQuery\Tests;
use PhpQuery\PhpQuery;
use PhpQuery\PhpQueryObject;

PhpQuery::use_function(__NAMESPACE__);

class BasicTest extends \PHPUnit_Framework_TestCase {
  function provider() {
    // TODO change filename
    return array(
      array(
        PhpQuery::newDocumentFile(__DIR__ . '/test.html')
      )
    );
  }

  /**
   * @param PhpQueryObject $pq
   * @dataProvider provider
   * @return void
   */
  function testFilterWithPseudoclass($pq) {
    $pq = $pq->find('p')->filter('.body:gt(1)');
    $result = array(
      'p.body',
    );

    $this->assertTrue($pq->whois() == $result);
  }

  /**
   * @param PhpQueryObject $pq
   * @dataProvider provider
   * @return void
   */
  function testSlice($pq) {
    $testResult = array(
      'li#testID',
    );
    $pq = $pq->find('li')->slice(1, 2);

    $this->assertTrue($pq->whois() == $testResult);
  }

  /**
   * @param PhpQueryObject $pq
   * @dataProvider provider
   * @return void
   */
  function testSlice2($pq) {
    // SLICE2
    $testResult = array(
      'li#testID',
      'li',
      'li#i_have_nested_list',
      'li.nested',
    );

    $pq = $pq->find('li')->slice(1, -1);

    $this->assertTrue($pq->whois() == $testResult);
  }

  /**
   * @return void
   */
  function testMultiInsert() {
    // Multi-insert
    $pq = PhpQuery::newDocument('<li><span class="field1"></span><span class="field1"></span></li>')->find('.field1')->php('longlongtest');
    $validResult = '<li><span class="field1"><php>longlongtest</php></span><span class="field1"><php>longlongtest</php></span></li>';
    similar_text($pq->htmlOuter(), $validResult, $similarity);

    $this->assertGreaterThan(80, $similarity);

  }

  /**
   * @param PhpQueryObject $pq
   * @dataProvider provider
   * @return void
   */
  function testIndex($pq) {
    $testResult = 1;
    $pq = $pq->find('p')->index($pq->find('p.title:first'));

    $this->assertTrue($pq == $testResult);
  }

  /**
   * @param PhpQueryObject $pq
   * @dataProvider provider
   * @return void
   */
  function testClone($pq) {
    $testResult = 3;
    $document = null;
    $pq = $pq->toReference($document)->find('p:first');

    foreach (array(
      0,
      1,
      2
    ) as $i) {
      $pq->clone()->addClass("clone-test")->addClass("class-$i")->insertBefore($pq);
    }

    $size = $document->find('.clone-test')->size();
    $this->assertEquals($testResult, $size);
  }

  /**
   * @param PhpQueryObject $pq
   * @dataProvider provider
   * @return void
   */
  function testNextSibling($pq) {
    $testResult = 3;
    $document = null;
    $result = $pq->find('li:first')->next()->next()->prev()->is('#testID');

    $this->assertTrue($result);
  }

  /**
   * @param PhpQueryObject $pq
   * @dataProvider provider
   * @return void
   */
  function testSimpleDataInsertion($pq) {
    $testName = 'Simple data insertion';
    $testResult = <<<EOF
<div class="articles">
        div.articles text node
        <ul>

        <li>
                <p>This is paragraph of first LI</p>
                <p class="title">News 1 title</p>
                <p class="body">News 1 body</p>
            </li>

<li>
                <p>This is paragraph of first LI</p>
                <p class="title">News 2 title</p>
                <p class="body">News 2 body</p>
            </li>
<li>
                <p>This is paragraph of first LI</p>
                <p class="title">News 3</p>
                <p class="body">News 3 body</p>
            </li>
</ul>
<p class="after">paragraph after UL</p>
    </div>
EOF;
    $expected_pq = PhpQuery::newDocumentHTML($testResult);
    $rows = array(
      array(
        'title' => 'News 1 title',
        'body' => 'News 1 body',
      ),
      array(
        'title' => 'News 2 title',
        'body' => 'News 2 body',
      ),
      array(
        'title' => 'News 3',
        'body' => 'News 3 body',
      ),
    );
    $articles = $pq->find('.articles ul');
    $rowSrc = $articles->find('li')->remove()->eq(0);
    foreach ($rows as $r) {
      $row = $rowSrc->_clone();
      foreach ($r as $field => $value) {
        $row->find(".{$field}")->html($value);
        //		die($row->htmlOuter());
      }
      $row->appendTo($articles);
    }
    $result = $pq->find('.articles')->htmlOuter();
    //         print htmlspecialchars("<pre>{$result}</pre>").'<br />';

    $this->assertEqualXMLStructure($expected_pq->find('.articles')->elements[0], $pq->find('.articles')->elements[0]);
    //         $this->assertEqualXMLStructure(DOMDocument::loadHTML($testResult)->documentElement, DOMDocument::loadHTML($result)->documentElement);
  }

  /**
   * @param PhpQueryObject $pq
   * @dataProvider provider
   * @return void
   */
  public function testCssParser() {
    PhpQuery::$enableCssShorthand = FALSE;

    $expected_html = '<div style="color:red;display:none;margin:20px;padding:10px"><span>Hello World!</span></div>';
    $expected_pq = PhpQuery::newDocumentHTML($expected_html);

    $test_pq = PhpQuery::newDocumentHTML('<div style="margin:10px; padding:10px">');
    $test = pq('div');
    $test->append('<span>Hello World!</span>');
    $test->hide();
    $test->css('color', 'red');
    $test->css('margin', '20px');
    $this->assertEqualXMLStructure($expected_pq->find('div')->elements[0], $test->elements[0]);
  }
}
