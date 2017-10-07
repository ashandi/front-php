<?php

namespace Ahandi\FrontPHP\Tests;

use PHPUnit\Framework\TestCase;
use Ashandi\FrontPHP\HtmlGenerator;
use Ashandi\FrontPHP\Exceptions\HtmlGenerationException;

class HtmlGeneratorTest extends TestCase
{
    public function testGetHtml()
    {
        $generator = new HtmlGenerator();

        $template = <<<'EOT'
<testTag class="{{class}}" id="{{id}}">{{content}}</testTag>
EOT;

        $replacements = [
            'class' => 'testClass',
            'id' => 'testId',
            'content' => 'testContent',
        ];

        $expected = <<<'EOT'
<testTag class="testClass" id="testId">testContent</testTag>
EOT;

        $generated = $generator->getHtml($template, $replacements);

        $this->assertEquals($expected, $generated);
    }

    public function testGetHtml_EmptyReplacement()
    {
        $generator = new HtmlGenerator();

        $template = <<<'EOT'
<testTag>{{content}}</testTag>
EOT;

        $this->expectException(HtmlGenerationException::class);

        $generator->getHtml($template);
    }
}
