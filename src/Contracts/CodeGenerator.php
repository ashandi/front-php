<?php

namespace Ashandi\FrontPHP\Contracts;

interface CodeGenerator
{
    /**
     * Returns html code of this entity (tag or view)
     *
     * @return string
     */
    public function getHtml();

    /**
     * Returns array of placeHolders and replacements for template
     *
     * @return array
     */
    public function getPlaceHoldersAndReplacements();

    /**
     * Returns template of this entity
     *
     * @return string
     */
    public function getTemplate();
}
