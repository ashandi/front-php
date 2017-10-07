<?php

namespace Ashandi\FrontPHP;

use Ashandi\FrontPHP\Contracts\CodeGenerator;
use Ashandi\FrontPHP\Contracts\ViewBuilder;
use Ashandi\FrontPHP\Traits\CodeGeneratorFunctionality;

final class View implements CodeGenerator
{

    use CodeGeneratorFunctionality;

    /**
     * @var string
     */
    private $title;

    /**
     * @var array
     */
    private $metaTags = [];

    /**
     * @var ViewBuilder
     */
    private $viewBuilder;

    /**
     * View constructor.
     * @param ViewBuilder $viewBuilder
     */
    public function __construct(ViewBuilder $viewBuilder)
    {
        $this->viewBuilder = $viewBuilder;
    }

    /**
     * Sets title of this page
     *
     * @param string $title
     * @return static
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Getter for title
     *
     * @return string
     */
    protected function getTitle()
    {
        if (!$this->title) {
            return '';
        }

        return '<title>' . $this->title . '</title>' . PHP_EOL;
    }

    /**
     * Adds given meta tag to this page
     *
     * @param Meta $metaTag
     * @return static
     */
    public function pushMeta(Meta $metaTag)
    {
        $this->metaTags[] = $metaTag;
        return $this;
    }

    /**
     * Returns html code of this page's meta tags
     *
     * @return string
     */
    protected function getMeta()
    {
        if (!$this->metaTags) {
            return '';
        }

        return implode(
            PHP_EOL,
            array_map(
                function (Meta $metaTag) {
                    return $metaTag->getHtml();
                },
                $this->metaTags)
            ) . PHP_EOL;
    }

    /**
     * Template of html page
     *
     * @return string
     */
    public function getTemplate()
    {
        return <<<'TEMP'
<!DOCTYPE html>
<html>
    <head>
        {{title}}{{meta}}
    </head>
    <body>
        
    </body>
</html>
TEMP;
    }

    /**
     * Method builds html code of this view
     * and returns it as a string
     *
     * @return string
     */
    public function render() : string
    {
        $this->viewBuilder->build();

        return $this->getHtml();
    }

    /**
     * Returns array of placeHolders and replacements for page's template
     *
     * @return array
     */
    public function getPlaceHoldersAndReplacements()
    {
        return [
            '{{title}}' => $this->getTitle(),
            '{{meta}}' => $this->getMeta(),
        ];
    }

    function __toString()
    {
        return $this->render();
    }
}
