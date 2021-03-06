<?php

declare(strict_types=1);

namespace ValidatorXSD;

class ErrorXSD
{
    /**
     * The severity of the error (one of the following constants: LIBXML_ERR_WARNING, LIBXML_ERR_ERROR, LIBXML_ERR_FATAL)
     * @var int $level
     */
    private int $level;

    /** @var int $code The error's code. */
    private int $code;

    /** @var int $column The column where the error occurred. */
    private int $column;

    /** @var string The error message, if any. */
    private string $message;

    /** @var string $file The filename, or empty if the XML was loaded from a string. */
    private string $file;

    /** @var int $line The line where the error occurred. */
    private int $line;

    /** @var string $facet Facet on which the error occurred. */
    private string $facet;

    /** @var string $facetMessage Error message (which facet returned). */
    private string $facetMessage;

    /** @var string $element Name of the field that caused the error. */
    private string $element;

    /**
     * Get severity of the error.
     * @return int
     */
    public function getLevel(): int
    {
        return $this->level;
    }

    /**
     * Set severity of the error.
     * @param int $level
     */
    public function setLevel(int $level): void
    {
        $this->level = $level;
    }

    /**
     * Get error code.
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * Set error code.
     * @param int $code
     */
    public function setCode(int $code): void
    {
        $this->code = $code;
    }

    /**
     * Get column where the error occurred.
     * @return int
     */
    public function getColumn(): int
    {
        return $this->column;
    }

    /**
     * Set column where the error occurred.
     * @param int $column
     */
    public function setColumn(int $column): void
    {
        $this->column = $column;
    }

    /**
     * Get error message.
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * Set error message.
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    /**
     * Get filename.
     * @return string
     */
    public function getFile(): string
    {
        return $this->file;
    }

    /**
     * Set filename.
     * @param string $file
     */
    public function setFile(string $file): void
    {
        $this->file = $file;
    }

    /**
     * Get line where the error occurred.
     * @return int
     */
    public function getLine(): int
    {
        return $this->line;
    }

    /**
     * Set line where the error occurred.
     * @param int $line
     */
    public function setLine(int $line): void
    {
        $this->line = $line;
    }

    /**
     * Get facet on which the error occurred.
     * @return string
     */
    public function getFacet(): string
    {
        return $this->facet;
    }

    /**
     * Set facet on which the error occurred
     * @param string $facet
     */
    public function setFacet(string $facet): void
    {
        $this->facet = $facet;
    }

    /**
     * Get the error message (which facet returned)
     * @return string
     */
    public function getFacetMessage(): string
    {
        return $this->facetMessage;
    }

    /**
     * Set the error message (which facet returned)
     * @param string $facetMessage
     */
    public function setFacetMessage(string $facetMessage): void
    {
        $this->facetMessage = $facetMessage;
    }

    /**
     * Get name of the field that caused the error
     * @return string
     */
    public function getElement(): string
    {
        return $this->element;
    }

    /**
     * Set name of the field that caused the error
     * @param string $element
     */
    public function setElement(string $element): void
    {
        $this->element = $element;
    }

    /**
     * Convert object to array
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'level' => $this->level,
            'code' => $this->code,
            'column' => $this->column,
            'message' => $this->message,
            'file' => $this->file,
            'line' => $this->line,
            'facet' => $this->facet,
            'facetMessage' => $this->facetMessage,
            'element' => $this->element,
        ];
    }
}
