<?php

declare(strict_types=1);

namespace ValidatorXSD;

use ValidatorXSD\Exceptions\LocalizationFailedImplement;

/**
 * Trait TranslateTrait
 *
 * @package ValidatorXSD
 */
class Translator
{
    /** @var LocalizationXSD $ruleAdapter Adapter for localization */
    private LocalizationXSD $ruleAdapter;

    /**
     * Translator constructor.
     *
     * @param string $ruleAdapter
     *
     * @throws LocalizationFailedImplement
     */
    public function __construct(string $ruleAdapter)
    {
        $class = new $ruleAdapter();
        if ($class instanceof LocalizationXSD) {
            $this->ruleAdapter = $class;
        } else {
            throw new LocalizationFailedImplement('Localization class not implements LocalizationXSD');
        }
    }
    
    /**
     * Localization error
     *
     * @param ErrorXSD $error
     */
    public function trans(ErrorXSD $error): void
    {
        $newElement = $this->translateKey($error->getElement());
        $error->setElement($newElement);

        $newMsg = $this->translateMessage($error);
        $error->setMessage($newMsg);
    }

    /**
     * Localization all errors
     *
     * @param CollectionErrorXSD|array<ErrorXSD> $errors
     */
    public function transAll($errors): void
    {
        foreach ($errors as $error) {
            $this->trans($error);
        }
    }

    /**
     * Translate attribute
     * @param string $key
     * @return string
     */
    public function translateKey(string $key): string
    {
        if (array_key_exists($key, $this->ruleAdapter->customAttributes())) {
            return $this->ruleAdapter->customAttributes()[$key];
        }
        return $key;
    }

    /**
     * Translate message
     * @param ErrorXSD $errorXSD
     * @return string
     */
    public function translateMessage(ErrorXSD $errorXSD): string
    {
        if (array_key_exists($errorXSD->getFacet(), $this->ruleAdapter->messages())) {
            $msg = $this->ruleAdapter->messages()[$errorXSD->getFacet()];
            return str_replace('${field}', $errorXSD->getElement(), $msg);
        }
        return $errorXSD->getMessage();
    }
}
