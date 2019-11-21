<?php

declare(strict_types=1);

namespace ADS\JsonLD\Exception;

use Exception;

final class NodeException extends Exception
{
    /**
     * @return static
     */
    public static function noKeyValueElements(array $array)
    {
        return new static(
            sprintf(
                'A JSON-LD node is an array of key value pairs. \'%s\' given.',
                print_r($array, true)
            )
        );
    }

    /**
     * @param mixed $key
     *
     * @return static
     */
    public static function keysMustBeIrisOrStartWithAt($key)
    {
        return new static(
            sprintf(
                'Found a JSON-LD node with a key that doesn\'t start with \'@\' or is not an iri: %s.',
                (string) $key
            )
        );
    }

    /**
     * @return static
     */
    public static function valueIsNotAnIri(string $key)
    {
        return new static(
            sprintf(
                'The value of an item of a JSON-LD node with key \'%s\' has to be an iri.',
                $key
            )
        );
    }
}
