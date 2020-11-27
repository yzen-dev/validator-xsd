## ValidatorXSD is a facade over DOMDocument. 

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
```php
    $data = '<XML>...</XML>';
    $validator = ValidatorXSD::init($data)
                ->loadSchema( './XSD/request.xsd')
                ->setLocalization(CustomLocalizationXSD::class);

    if (!$validator->validate()) {
        foreach ($validator->getErrors() as $error) {
            var_dump($error);
        }
    }
```
```php
object(ValidatorXSD\ErrorXSD)[2404]
  private int 'level' => int 2
  private int 'code' => int 1831
  private int 'column' => int 0
  private string 'message' => string 'Поле "Страна" меньше минимальной длины.' (length=71)
  private string 'file' => string '/var/www/test/public/' (length=31)
  private int 'line' => int 1
  private string 'rule' => string 'minLength' (length=9)
  private string 'ruleMessage' => string 'The value has a length of '0'; this underruns the allowed minimum length of '1'.' (length=80)
  private string 'element' => string 'Страна' (length=12)
```

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
