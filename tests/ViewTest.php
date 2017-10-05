<?php

namespace Ahandi\FrontPHP\Tests;

use Ashandi\FrontPHP\View;
use PHPUnit\Framework\TestCase;

class ViewTest extends TestCase
{
    public function testRender()
    {
        $testView = new TestView();

        $expectedHtml = <<<'EOT'
<!DOCTYPE html>
<html>
    <head>
        
    </head>
    <body>
        
    </body>
</html>
EOT;

        $generatedHtml = $testView->render();

        $this->assertEquals($expectedHtml, $generatedHtml);
    }

    public function testSetTitle()
    {
        $testView = (new TestView())
            ->setTitle('unit testing');

        $html = $testView->render();

        $this->assertContains('<title>unit testing</title>', $html);
    }
}

class TestView extends View {}

