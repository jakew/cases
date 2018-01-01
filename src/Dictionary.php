<?php

namespace JakeW\Cases;

/**
 * A store for special words that might have medial capitals.
 *
 * @package JakeW\Cases
 */
class Dictionary
{
    /**
     * @var Dictionary The singleton instance of this dictionary.
     */
    static protected $instance;

    /** @var string[][] The pairs of capital and lowercase words indexed by the strtolower version of each. */
    protected $words;

    /** Protected constructor to avoid outside instantiation. */
    protected function __construct() {}

    /**
     * Add a word to the singletons dictionary.
     *
     * @param string $capitalCase The capital version of the word.
     * @param string|null $lowerCase The lowercase version, in case it is different from the capital case but all lower.
     */
    public function addWord(string $capitalCase, string $lowerCase = null)
    {
        if ($lowerCase == null) {
            $lowerCase = strtolower($capitalCase);
        }

        $index = strtolower($lowerCase);
        $record = [$capitalCase, $lowerCase];

        $this->words[$index] = $record;

        if ($index !== strtolower($capitalCase)) {
            $this->words[strtolower($capitalCase)] = $record;
        }
    }

    /**
     * Returns an instance of Word or SpecialWord for the word provided.
     *
     * @param string $word The word we are looking to get.
     * @return SpecialWord|Word The Word instance if it is normal, and SpecialWord if it exists in our store.
     */
    public function getWord(string $word)
    {
        if (isset($this->words[strtolower($word)])) {
            return new SpecialWord($word, $this->words[strtolower($word)][0], $this->words[strtolower($word)][1]);
        }

        return new Word($word);
    }

    /**
     * Returns the current and only instance of this dictionary.
     *
     * @return Dictionary The instance of this dictionary.
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Dictionary();
        }

        return self::$instance;
    }
}
