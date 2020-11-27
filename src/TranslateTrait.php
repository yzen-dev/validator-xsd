<?php

declare(strict_types=1);

namespace ValidatorXSD;

/**
 * Trait TranslateTrait
 *
 * @package ValidatorXSD
 */
trait TranslateTrait
{
    /**
     * Localization error
     *
     * @param ErrorXSD $error
     */
    private function trans(ErrorXSD $error): void
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
    private function transAll($errors): void
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
        if (array_key_exists($errorXSD->getRule(), $this->ruleAdapter->messages())) {
            $msg = $this->ruleAdapter->messages()[$errorXSD->getRule()];
            return str_replace('${field}', $errorXSD->getElement(), $msg);
        }
        return $errorXSD->getMessage();
    }
}
