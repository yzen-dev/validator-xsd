<?php

declare(strict_types=1);

namespace ValidatorXSD;

use LibXMLError;

/**
 * Class ParseLibXMLError
 *
 * @package ValidatorXSD
 */
class ParseLibXMLError
{
    /**
     * Casting LibXMLError errors to ErrorXSD
     *
     * @param LibXMLError $error
     *
     * @return ErrorXSD
     */
    public static function parse(LibXMLError $error): ErrorXSD
    {
        $errorXSD = new ErrorXSD();
        $errorXSD->setCode($error->code);
        $errorXSD->setColumn($error->column);
        $errorXSD->setFile($error->file);
        $errorXSD->setLevel($error->level);
        $errorXSD->setLine($error->line);
        $errorXSD->setMessage($error->message);

        preg_match('/^Element \'([a-zA-Z]*)\'/', $error->message, $element);
        $errorXSD->setElement($element[1]);

        preg_match('/\[facet \'([a-zA-Z]*)\'\]/', $error->message, $facet);
        $errorXSD->setFacet($facet[1] ?? 'empty');
        if ($errorXSD->getFacet() === 'empty' && preg_match('/This element is not expected\./u', $errorXSD->getFacet())) {
            $errorXSD->setFacet('notExpected');
        }

        preg_match('/\[facet \'[a-zA-Z]*\'\] ([\w\W]*)\n|(\'\'[\w\W]*)/', $error->message, $facetMessage);
        $facetMessage = array_values(array_filter($facetMessage));
        if (isset($facetMessage[1])) {
            $errorXSD->setFacetMessage($facetMessage[1]);
        } else {
            preg_match('/^Element \'[a-zA-Z]*\': ([\w\W]*)/', $error->message, $facetMessage);
            $errorXSD->setFacetMessage($facetMessage[1] ?? 'empty');
        }


        return $errorXSD;
    }
}
