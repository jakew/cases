<?php

namespace JakeW\Cases;

/**
 * An extension of the Word class to support abnormal cases such as medial capitals.
 *
 * @see Word
 * @package JakeW\Cases
 */
class SpecialWord extends Word
{
    /** @var string The word as it should appear when capitalized. */
    protected $capitalWord;

    /** @var string The word as it should appear when in a lower case. */
    protected $lowerWord;

    /**
     * Creates an instance of this special word.
     *
     * @param string $word The word as used to when locating it in the Dictionary.
     * @param string $capitalWord The word as it should appear when capitalized.
     * @param string $lowerWord The word as it should appear when in a lower case.
     */
    public function __construct(string $word, string $capitalWord, string $lowerWord)
    {
        $this->capitalWord = $capitalWord;
        $this->lowerWord = $lowerWord;

        parent::__construct($word);
    }

    /**
     * Returns the word, capitalized.
     *
     * @return string The word capitalized as indicated by the Dictionary.
     */
    public function getCapitalCase()
    {
        return $this->capitalWord;
    }

    /**
     * Returns the word entirely in lowercase.
     *
     * @return string The word entirely in lowercase or as indicated by the Dictionary.
     */
    public function getLowerCase()
    {
        return $this->lowerWord;
    }

    /**
     * Returns the word entirely in uppercase.
     *
     * @return string The word entirely in uppercase.
     */
    public function getUpperCase()
    {
        return strtoupper($this->capitalWord);
    }
}
