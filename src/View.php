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
        return $this->title
            ? '<title>' . $this->title . '</title>'
            : '';
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
        {{title}}
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
        ];
    }

    function __toString()
    {
        return $this->render();
    }
}
