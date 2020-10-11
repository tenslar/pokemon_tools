<?php

namespace App\Domain;

class Pokemon
{
    public static function make(string $name, array $types)
    {
        if (count($types) > 1) {
            return new Pokemon($name, $types[0], $types[1]);
        }
        return new Pokemon($name, $types[0]);
    }

    private $name;
    private $types;

    public function __construct(string $name, Type ...$types)
    {
        if (empty($name)) {
            throw new \RuntimeException('No name is set.');
        }
        $this->name = $name;

        $type_count = count($types);
        if ($type_count > 2) {
            throw new \RuntimeException('Too many types set.');
        }

        if ($type_count < 1) {
            throw new \RuntimeException('No types set.');
        }

        if ($type_count === 2 && $types[0]->name() === $types[1]->name()) {
            throw new \RuntimeException('Same type cannot be set.');
        }

        $this->types = $types;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function types(): array
    {
        return $this->types;
    }
}