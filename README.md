## ValidatorXSD is a facade over DOMDocument. 
![Packagist Version](https://img.shields.io/packagist/v/yzen.dev/validator-xsd?color=%23007ec6&style=plastic)
![Packagist Downloads](https://img.shields.io/packagist/dm/yzen.dev/validator-xsd)
![Packagist Downloads](https://img.shields.io/packagist/dt/yzen.dev/validator-xsd)

ValidatorXSD is a DOMDocument facade that will allow you to more conveniently validate your XML file and also localize errors.

## :scroll: **Installation**
The package can be installed via composer:
```
composer require yzen.dev/validator-xsd
```

## :scroll: **Features**
* Simple use
* Casting LibXMLError errors to ErrorXSD
* Parsing fields, rules and more from an error
* The ability to localize validator errors

## :scroll: **Usage**
Validate xml by schema:
```php
    $data = '<XML>...</XML>';
    $validator = ValidatorXSD::init($data)
                ->loadSchema( './XSD/request.xsd')
                ->setLocalization(CustomLocalizationXSD::class);
    echo $validator->validate();
```
Get all error:
```php
    if (!$validator->validate()) {
        foreach ($validator->getErrors() as $error) {
            var_dump($error);
        }
    }
```
Pluck result and group by field:
```php
    $errors = $validator->getErrors()
                ->pluck(['element','message'])
                ->groupBy('element');
```

Create custom localization
```php
class CustomLocalizationXSD implements LocalizationXSD
{
    public function customAttributes(): array
    {
        return [
            'Country' => 'Страна',
            'Province' => 'Область',
        ];
    }
    
    public function messages(): array
    {
        return [
            'minLength' => 'Поле "${field}" меньше минимальной длины.',
        ];
    }
}
```
