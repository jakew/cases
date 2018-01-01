<?php

namespace JakeW\Cases\Tests;

use PHPUnit\Framework\TestCase;
use JakeW\Cases\SpecialWord;

class SpecialWordTest extends TestCase
{
    protected $word;

    public function setUp()
    {
        $this->word = new SpecialWord('Email', 'eMail', 'email');
    }

    public function testGetWord()
    {
        $this->assertEquals('Email', $this->word->getWord());
    }

    public function testGetCapitalCase()
    {
        $this->assertEquals('eMail', $this->word->getCapitalCase());
    }

    public function testGetLowerCase()
    {
        $this->assertEquals('email', $this->word->getLowerCase());
    }

    public function testGetUpperCase()
    {
        $this->assertEquals('EMAIL', $this->word->getUpperCase());
    }
}
