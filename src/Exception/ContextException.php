<?php

declare(strict_types=1);

namespace ADS\JsonLD\Exception;

use Exception;

final class ContextException extends Exception
{
    /**
     * @param mixed $value
     *
     * @return static
     */
    public static function valueIsNodeOrIri($value)
    {
        return new static(
            sprintf(
                'The value of JSON-LD context needs to be an IRI or a JSON-LD node. \'%s\' given.',
                (string) $value
            )
        );
    }
}
