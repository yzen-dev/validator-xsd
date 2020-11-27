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
        
        preg_match('/\[facet \'([a-zA-Z]*)\'\]/', $error->message, $rule);
        $errorXSD->setRule($rule[1]);
        
        preg_match('/\[facet \'[a-zA-Z]*\'\] ([\w\W]*)\n/', $error->message, $ruleMessage);
        $errorXSD->setRuleMessage($ruleMessage[1]);
        
        
        return $errorXSD;
    }
}
