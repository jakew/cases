<?php

namespace JakeW\Cases;

/**
 * A simple abstraction wrapper around a string "word". Primarily used to create a consistent interface with non-obvious
 * words.
 *
 * @package JakeW\Cases
 */
class Word
{
    /** @var string The word this Word represents in its originally supplied case. */
    private $word = '';

    /**
     * The word this Word is to represent.
     *
     * @param string $word The word this Word represents in its originally supplied case.
     */
    public function __construct(string $word)
    {
        $this->word = $word;
    }

    /**
     * Returns the original word.
     *
     * @return string The word this Word represents in its originally supplied case.
     */
    public function getWord()
    {
        return $this->word;
    }

    /**
     * Returns the word, capitalized.
     *
     * @return string The word with the first letter uppercase, and the rest lowercase.
     */
    public function getCapitalCase()
    {
        return ucfirst(strtolower($this->word));
    }

    /**
     * Returns the word entirely in lowercase.
     *
     * @return string The word entirely in lowercase.
     */
    public function getLowerCase()
    {
        return strtolower($this->word);
    }

    /**
     * Returns the word entirely in uppercase.
     *
     * @return string The word entirely in uppercase.
     */
    public function getUpperCase()
    {
        return strtoupper($this->word);
    }
}
