<?php

declare(strict_types=1);

namespace ValidatorXSD;

/**
 * Interface LocalizationXSD
 * @package ValidatorXSD
 */
interface LocalizationXSD
{
    /**
     * The array of custom attribute names.
     * @return array<string,string>
     */
    public function customAttributes(): array;

    /**
     * The array of custom error messages.
     * @return array<string,string>
     */
    public function messages(): array;
}
