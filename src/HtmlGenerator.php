<?php

namespace Ashandi\FrontPHP;

use Ashandi\FrontPHP\Exceptions\HtmlGenerationException;

final class HtmlGenerator
{

    /**
     * This method returns given template
     * where placeHolders are replaced with given replacements
     * TODO рекурсивный вызов, если replacement - Tag or View (interface HtmlRenderer)
     *
     * @param string $template
     * @param array $replacements
     * @return string
     * @throws HtmlGenerationException
     */
    public function getHtml(string $template, array $replacements = []) : string
    {
        $template = str_replace(
            $this->decoratePlaceHolders(array_keys($replacements)),
            array_values($replacements),
            $template
        );

        $unknownPlaceHolders = $this->findPlaceHolders($template);
        if (count($unknownPlaceHolders) > 0) {
            //TODO переделать
            throw new HtmlGenerationException('Undefined placeHolders in your view: ' . print_r($unknownPlaceHolders, true));
        }

        return $template;
    }

    /**
     * Method adds two curly-braces from both sides of given placeHolders
     *
     * @param array $placeHolders
     * @return array
     */
    private function decoratePlaceHolders(array $placeHolders) : array
    {
        return array_map(function (string $placeHolder) {
            return '{{' . $placeHolder . '}}';
        }, $placeHolders);
    }

    /**
     * Returns array of placeHolders in given template
     *
     * @param string $template
     * @return array
     */
    private function findPlaceHolders(string $template) : array
    {
        $result = preg_match_all('/{{\w+}}/', $template, $matches, PREG_OFFSET_CAPTURE);

        return $result ? $matches : [];
    }
}
