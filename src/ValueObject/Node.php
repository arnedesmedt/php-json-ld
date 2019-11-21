<?php

declare(strict_types=1);

namespace ADS\JsonLD\ValueObject;

use ADS\ImmutableObjects\Implementation\Iterable\ArrayValue;
use ADS\ImmutableObjects\Implementation\Object\KeyValueValue;
use ADS\JsonLD\Exception\NodeException;

class Node extends ArrayValue
{
    protected function __construct(array $array)
    {
        // TODO: Does a node require an id or a type??

        foreach ($array as $value) {
            if (! $value instanceof KeyValueValue) {
                throw NodeException::noKeyValueElements($array);
            }

            $key = $value->key();
            if ($key instanceof Iri) {
                continue;
            }

            if (strpos('@', (string) $key) === 0) {
                if (in_array((string) $key, ['@id', '@type']) && ! $value->value() instanceof Iri) {
                    throw NodeException::valueIsNotAnIri((string) $key);
                }

                continue;
            }

            throw NodeException::keysMustBeIrisOrStartWithAt($key);
        }

        parent::__construct($array);
    }
}
