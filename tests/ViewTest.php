<?php

namespace Ahandi\FrontPHP\Tests;

use Ashandi\FrontPHP\Meta;
use Ashandi\FrontPHP\View;
use PHPUnit\Framework\TestCase;
use Ashandi\FrontPHP\Contracts\ViewBuilder;
use PHPUnit_Framework_MockObject_MockObject;

class ViewTest extends TestCase
{
    public function testRender()
    {
        /** @var ViewBuilder | PHPUnit_Framework_MockObject_MockObject $customView */
        $customView = $this->createMock(ViewBuilder::class);
        $customView->expects($this->once())
            ->method('build');

        $view = new View($customView);

        $expectedHtml = <<<'EOT'
<!DOCTYPE html>
<html>
    <head>
        
    </head>
    <body>
        
    </body>
</html>
EOT;

        $generatedHtml = $view->render();

        $this->assertEquals($expectedHtml, $generatedHtml);
    }

    /*public function testSetTitle()
    {
        $testView = (new View())
            ->setTitle('unit testing');

        $html = $testView->render();

        $this->assertContains('<title>unit testing</title>', $html);
    }*/

   /* public function testPushMeta()
    {
        /** @var Meta|PHPUnit_Framework_MockObject_MockObject $testMeta *//*
        $testMeta = $this->createMock(Meta::class);
        $testMeta->expects($this->any())
            ->method('getHtml')
            ->willReturn('<meta name="test" content="test">');

        $testView = (new View())
            ->pushMeta($testMeta);

        $html = $testView->render();

        $this->assertContains('<meta name="test" content="test">', $html);
    }*/
}
