<?php

declare(strict_types=1);

namespace ADS\JsonLD\ValueObject;

use ADS\ImmutableObjects\Implementation\String\StringValue;
use ADS\JsonLD\Exception\IriException;

class Iri extends StringValue
{
    /** @var string|null */
    private $prefix;

    protected function __construct(string $value, ?string $prefix = null)
    {
        parent::__construct($value);

        $this->prefix = $prefix;
    }

    /**
     * @return static
     */
    public static function fromStringWithPrefix(string $value)
    {
        if (strpos(':', $value) === false) {
            throw IriException::noContextString($value);
        }

        [$context, $value] = explode(':', $value);

        return new static($value, $context);
    }

    public function toContextString(array $prefix) : string
    {
        if ($this->prefix === null) {
            throw IriException::emptyContext($this->value);
        }

        $allContexts = array_keys($prefix);

        if (! in_array($this->prefix, $allContexts)) {
            throw IriException::contextNotProvided($this->value, $this->prefix, $allContexts);
        }

        return sprintf('%s:%s', $this->prefix, $this->value);
    }

    public function isExternal() : bool
    {
        return $this->prefix === null;
    }
}
