<?php

declare(strict_types=1);

namespace ADS\JsonLD\ValueObject;

use ADS\ImmutableObjects\Implementation\Object\ObjectValue;
use ADS\JsonLD\Exception\ContextException;

class Context extends ObjectValue
{
    protected function __construct(array $array)
    {
        foreach ($array as $value) {
            if ($value instanceof Iri || $value instanceof Node) {
                continue;
            }

            throw ContextException::valueIsNodeOrIri($value);
        }

        parent::__construct($array);
    }
}
