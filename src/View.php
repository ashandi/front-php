<?php

namespace Ashandi\FrontPHP;

use Ashandi\FrontPHP\Contracts\CodeGenerator;
use Ashandi\FrontPHP\Traits\CodeGeneratorFunctionality;

abstract class View implements CodeGenerator
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
     * Method transforms this class in html code
     * and returns it as a string
     *
     * @return string
     */
    public function render()
    {
        $this->build();

        return $this->getHtml();
    }

    /**
     * Method for building the page
     * Implement this method in descendant's View
     */
    protected function build()
    {
        //TODO Implement this method in descendant
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
