<?php

namespace Ashandi\FrontPHP\Traits;

use Ashandi\FrontPHP\Contracts\CodeGenerator;

trait CodeGeneratorFunctionality
{
    /**
     * @return string
     */
    public function getHtml()
    {
        /** @var CodeGenerator $this */

        $placeHoldersAndReplacements = $this->getPlaceHoldersAndReplacements();

        $code = $this->getTemplate();
        foreach ($placeHoldersAndReplacements as $placeHolder => $replacement) {
            $code = str_replace($placeHolder, $replacement, $code);
        }

        return $code;
    }
}
