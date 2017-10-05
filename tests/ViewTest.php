<?php

namespace Ahandi\FrontPHP\Tests;

use Ashandi\FrontPHP\Meta;
use Ashandi\FrontPHP\View;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

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

    public function testPushMeta()
    {
        /** @var Meta|PHPUnit_Framework_MockObject_MockObject $testMeta */
        $testMeta = $this->createMock(Meta::class);
        $testMeta->expects($this->any())
            ->method('getHtml')
            ->willReturn('<meta name="test" content="test">');

        $testView = (new TestView())
            ->pushMeta($testMeta);

        $html = $testView->render();

        $this->assertContains('<meta name="test" content="test">', $html);
    }
}

class TestView extends View {}

