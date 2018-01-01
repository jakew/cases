<?php

namespace JakeW\Cases\Tests;


use JakeW\Cases\Dictionary;
use PHPUnit\Framework\TestCase;
use JakeW\Cases\Phrase;

class PhraseTest extends TestCase
{
    public function setUp()
    {
        Dictionary::getInstance()->addWord('iPhone', 'iphone');
    }

    protected function cleanWords($words)
    {
        foreach ($words as &$word) {
            $word = $word->getWord();
        }

        return $words;
    }

    #-- Test Decoding

    public function testDecodeUpperCamelCase()
    {
        $phrase = Phrase::decodeCamelCase('ThisIsUpperCamelCase');
        $array = ['This', 'Is', 'Upper', 'Camel', 'Case'];

        $this->assertEquals($array, $this->cleanWords($phrase->getWords()));
    }

    public function testDecodeUpperCamelCaseWithHyphensAndUnderscores()
    {
        $phrase = Phrase::decodeCamelCase('ThisIsTerribleUp-perCamel_case');
        $array = ['This', 'Is', 'Terrible', 'Up-per', 'Camel_case'];

        $this->assertEquals($array, $this->cleanWords($phrase->getWords()));
    }

    public function testDecodeLowerCamelCase()
    {
        $phrase = Phrase::decodeCamelCase('thisIsLowerCamelCase');
        $array = ['this', 'Is', 'Lower', 'Camel', 'Case'];

        $this->assertEquals($array, $this->cleanWords($phrase->getWords()));
    }

    public function testDecodeHyphenSnakeCase()
    {
        $phrase = Phrase::decodeSnakeCase('This-Is-Hyphen-Snake_Case');
        $array = ['This', 'Is', 'Hyphen', 'Snake_Case'];

        $this->assertEquals($array, $this->cleanWords($phrase->getWords()));
    }

    public function testDecodeUnderscoreSnakeCase()
    {
        $phrase = Phrase::decodeSnakeCase('This_Is_Underscore_Snake-Case', '_');
        $array = ['This', 'Is', 'Underscore', 'Snake-Case'];

        $this->assertEquals($array, $this->cleanWords($phrase->getWords()));
    }

    public function testDecodeAll()
    {
        $phrase = Phrase::decode('This-Is-Hyphen-Snake_Case');
        $array = ['This', 'Is', 'Hyphen', 'Snake', 'Case'];

        $this->assertEquals($array, $this->cleanWords($phrase->getWords()));
    }

    public function testSnakeCaseToUpperCamelCase()
    {
        $phrase = Phrase::decode('this_is_a_snake_case_test');
        $camelCase = 'ThisIsASnakeCaseTest';

        $this->assertEquals($camelCase, $phrase->getCamelCase());
    }

    public function testSnakeCaseToLowerCamelCase()
    {
        $phrase = Phrase::decode('this_is_a_snake_case_test');
        $camelCase = 'ThisIsASnakeCaseTest';

        $this->assertEquals($camelCase, $phrase->getCamelCase(false));
    }

    public function testCamelCaseToHyphenSnakeCase()
    {
        $phrase = Phrase::decode('ThisIsASnakeCaseTest');
        $snakeCase = 'this-is-a-snake-case-test';

        $this->assertEquals($snakeCase, $phrase->getSnakeCase());
    }

    public function testCamelCaseToUnderscoreSnakeCase()
    {
        $phrase = Phrase::decode('ThisIsASnakeCaseTest');
        $snakeCase = 'this_is_a_snake_case_test';

        $this->assertEquals($snakeCase, $phrase->getSnakeCase('_'));
    }
}
