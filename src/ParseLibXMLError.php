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
        $errorXSD->setFacet($facet[1]);
        
        preg_match('/\[facet \'[a-zA-Z]*\'\] ([\w\W]*)\n/', $error->message, $facetMessage);
        $errorXSD->setFacetMessage($facetMessage[1]);
        
        
        return $errorXSD;
    }
}
