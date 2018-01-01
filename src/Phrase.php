<?php

namespace JakeW\Cases;


/**
 * A phrase or series of words used to describe something, with the ability to switch between camel and snake case
 * varients.
 *
 * @package JakeW\Cases
 */
class Phrase
{
    /** @const string Used when the case is merely glued with a specific character. */
    const CONCATENATION_TYPE_GLUE = 'glue';

    /** @const string Used when the capitalization of words is used to identify specific words. */
    const CONCATENATION_TYPE_CAPITALIZATION = 'capitalization';

    /** @const string Used when there may be both glue and capitalized words used. */
    const CONCATENATION_TYPE_ALL = 'all';

    /** @var Word[] The words stored in this phrase in the order that they should be printed. */
    protected $words = [];

    /**
     * Creates an instance of this object with the words provided.
     *
     * @param Word[] ...$words The words we are storing and using to generate strings.
     */
    public function __construct(Word ...$words)
    {
        $this->words = $words;
    }

    /**
     * Returns the phrase as camel case.
     *
     * @TODO: Finish acroynm length system.
     *
     * @param bool $upperCamelCase True if the first _word_ should be capitalized.
     * @param int|null $acronymMaxLength If set, acronyms will be all capitalized up to a specific length.
     * @return string The camel cased version of the phrase.
     */
    public function getCamelCase(bool $upperCamelCase = true, int $acronymMaxLength = null): string
    {
        $phrase = '';

        // Combine letters to make sure acronym max length is preserved.

        foreach ($this->words as $word) {

            if (!$upperCamelCase) {
                $phrase .= $word->getCapitalCase();
                $upperCamelCase = true;
                continue;
            }

            $phrase .= $word->getCapitalCase();
        }

        return $phrase;
    }

    /**
     * Returns the snake case version with the glue provided.
     *
     * @param string $glue The glue between words. Common examples would be '-', '_' and ' '.
     * @return string The snake case version of the phrase.
     */
    public function getSnakeCase(string $glue = '-')
    {
        $words = [];

        foreach ($this->words as $word) {
            $words[] = $word->getLowerCase();
        }

        return implode($glue, $words);
    }

    /**
     * The Word objects as provided when creating the phrase.
     *
     * @return Word[] The Word objects as provided.
     */
    public function getWords(): array
    {
        return $this->words;
    }

    /**
     * Given a phrase as a string, and a few options, break it down into individual Word objects and create a Phrase
     * with them.
     *
     * @param string $phrase The phrase we are starting with.
     * @param string $concatenationType The type of the concatenation.
     * @param string|null $glue The glue we should use specifically. This can be a list of chars (except /).
     * @return Phrase The resulting object, created with the words we separated.
     */
    public static function decode(
        string $phrase,
        string $concatenationType = self::CONCATENATION_TYPE_ALL,
        string $glue = null
    ) {
        if ($concatenationType == self::CONCATENATION_TYPE_CAPITALIZATION ||
            $concatenationType == self::CONCATENATION_TYPE_ALL) {
            $phrase = preg_split('/(?=[A-Z])/', $phrase);
        } else {
            $phrase = [$phrase];
        }

        if ($concatenationType == self::CONCATENATION_TYPE_GLUE ||
            $concatenationType == self::CONCATENATION_TYPE_ALL) {
            $newWords = [];

            foreach ($phrase as $i) {
                array_push($newWords, ...self::unglue($i, $glue));
            }

            $phrase = $newWords;
        }

        $phrase = array_filter($phrase);

        foreach ($phrase as &$word) {
            $word = Dictionary::getInstance()->getWord($word);
        }

        return new self(...$phrase);
    }

    /**
     * Given one or more characters as glue, separate a string into an array of strings.
     *
     * @param string $string The string we are separating.
     * @param string|null $glue The characters that are combining the string.
     * @return string[] The segments of the string after being separated.
     */
    protected static function unglue(string $string, string $glue = null): array
    {
        $glue = ($glue === null) ? '-_ ' : $glue;
        return preg_split("/[" . $glue . "]+/", $string);
    }

    /**
     * Convenience method to separate camel case words.
     *
     * @param string $phrase The camel cased string.
     * @return Phrase The object with each word, ready to be converted.
     */
    public static function decodeCamelCase(string $phrase)
    {
        return self::decode($phrase, self::CONCATENATION_TYPE_CAPITALIZATION);
    }

    /**
     * Convenience method to separate snake cased words.
     *
     * @param string $phrase The snake cased string.
     * @param string $glue The character(s) to separate by.
     * @return Phrase The object with each word, ready to be converted.
     */
    public static function decodeSnakeCase(string $phrase, string $glue = '-')
    {
        return self::decode($phrase, self::CONCATENATION_TYPE_GLUE, $glue);
    }
}
