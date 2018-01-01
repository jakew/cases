<?php
/**
 * Created by PhpStorm.
 * User: jakew
 * Date: 2018-01-01
 * Time: 1:24 AM
 */

namespace JakeW\Cases\Tests;

use PHPUnit\Framework\TestCase;
use JakeW\Cases\Word;

class WordTest extends TestCase
{
    protected $word;

    public function setUp()
    {
        $this->word = new Word('teSt');
    }

    public function testGetWord()
    {
        $this->assertEquals('teSt', $this->word->getWord());
    }

    public function testGetCapitalCase()
    {
        $this->assertEquals('Test', $this->word->getCapitalCase());
    }

    public function testGetLowerCase()
    {
        $this->assertEquals('test', $this->word->getLowerCase());
    }

    public function testGetUpperCase()
    {
        $this->assertEquals('TEST', $this->word->getUpperCase());
    }
}
