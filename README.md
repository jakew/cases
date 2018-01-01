# jakew/cases
A PHP tool to be able to convert from and to many different programming cases.

## Example Use

```php
// You can add custom words in, for special cases.
Dictionary::getInstance()->addWord('eMail', 'email');

$phrase = Phrase::decode('ExamplePhrase');
echo $phrase->getSnakeCase();
# example-phrase

$phrase = Phrase::decode('ExamplePhrase');
echo $phrase->getSnakeCase('_');
# example_phrase

$phrase = Phrase::decode('example-phrase');
echo $phrase->getCamelCase();
# ExamplePhrase

$phrase = Phrase::decode('email_phrase');
echo $phrase->getCamelCase(false);
# examplePhrase

$phrase = Phrase::decode('email-address');
echo $phrase->getCamelCase();
# eMailAddress
```

This allows us to have words that may have medial capitals still be correct when lower and upper cases are used.