<?php

declare(strict_types=1);

namespace ValidatorXSD;

use LibXMLError;
use ValidatorXSD\Exceptions\LocalizationFailedImplement;
use DOMDocument;

/**
 * Class ValidatorXSD
 *
 * @package ValidatorXSD
 */
class ValidatorXSD
{
    /** @var DOMDocument $xmlDom Represents an entire XML document; serves as the root of the document tree. */
    private DOMDocument $xmlDom;

    /** @var string The path to the schema. */
    private string $schema;

    /** @var array<LibXMLError> $errors array of errors. */
    private array $errors = [];

    /** @var Translator|null $translator Errors translator. */
    private ?Translator $translator;

    /**
     * Load XML from a string
     *
     * @param string $source The string containing the XML.
     */
    public function __construct(string $source)
    {
        $this->xmlDom = new DOMDocument();
        $this->xmlDom->loadXML($source);
    }

    /**
     * Load XML from a string
     *
     * @param string $source The string containing the XML.
     *
     * @return ValidatorXSD
     */
    public static function init(string $source): self
    {
        return new self($source);
    }

    /**
     * Validate schema
     *
     * @return bool true on success or false on failure.
     */
    public function validate(): bool
    {
        libxml_use_internal_errors(true);
        $success = $this->xmlDom->schemaValidate($this->schema);

        if (!$success) {
            $this->errors = libxml_get_errors();
            libxml_clear_errors();
        }
        return $success;
    }

    /**
     * Set scheme according to which it will be necessary to check
     *
     * @param string $filename The path to the schema.
     *
     * @return ValidatorXSD
     */
    public function loadSchema(string $filename): self
    {
        $this->schema = $filename;
        return $this;
    }

    /**
     * Get errors collection
     *
     * @return CollectionErrorXSD|ErrorXSD[]
     */
    public function getErrors(): CollectionErrorXSD
    {
        $collection = new CollectionErrorXSD($this->errors);
        if ($this->translator) {
            $this->translator->transAll($collection);
        }
        return $collection;
    }

    /**
     * @param string $ruleAdapter
     *
     * @return ValidatorXSD
     * @throws LocalizationFailedImplement
     */
    public function setLocalization(string $ruleAdapter): self
    {
        $this->translator = new Translator($ruleAdapter);
        return $this;
    }
}
