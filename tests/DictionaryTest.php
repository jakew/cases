<?php

namespace JakeW\Cases\Tests;


use PHPUnit\Framework\TestCase;
use JakeW\Cases\Dictionary;

class DictionaryTest extends TestCase
{
    public function setUp()
    {
        Dictionary::getInstance()->addWord('eMail', 'e-mail');
    }

    public function testGetWord()
    {
        $normalWord = Dictionary::getInstance()->getWord('computer');
        $this->assertEquals('Computer', $normalWord->getCapitalCase());
    }

    public function testGetSpecialWord()
    {
        $specialWord = Dictionary::getInstance()->getWord('email');
        $this->assertEquals('eMail', $specialWord->getCapitalCase());
    }

    public function testGetInstance()
    {
        $this->assertInstanceOf(Dictionary::class, Dictionary::getInstance());
        $this->assertEquals(Dictionary::getInstance(), Dictionary::getInstance());
    }
}
