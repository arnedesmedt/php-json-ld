<?php

declare(strict_types=1);

namespace ADS\JsonLD\Exception;

use Exception;

final class IriException extends Exception
{
    /**
     * @return static
     */
    public static function noContextString(string $string)
    {
        return new static(
            sprintf(
                'Could not create an iri from \'%s\' with a context.',
                $string
            )
        );
    }

    /**
     * @return static
     */
    public static function contextNotProvided(string $value, string $context, array $allContexts)
    {
        return new static(
            sprintf(
                'Could not find context \'%s\' in the listed contexts \'%s\' for iri \'%s\'',
                $context,
                print_r($allContexts, true),
                $value
            )
        );
    }

    /**
     * @return static
     */
    public static function emptyContext(string $value)
    {
        return new static(
            sprintf(
                'Iri \'%s\' has no contexts and requires one.',
                $value
            )
        );
    }
}
