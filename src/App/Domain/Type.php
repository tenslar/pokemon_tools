<?php

namespace App\Domain;

class Type
{
    const AVAILABLE_TYPE_LIST = [
        'normal',
        'fire',
        'water',
        'electric',
        'grass',
        'ice',
        'fighting',
        'poison',
        'ground',
        'flying',
        'psychic',
        'bug',
        'rock',
        'ghost',
        'dragon',
        'dark',
        'steel',
        'fairy',
    ];

    private $name;

    public function __construct(string $type_name)
    {
        if ($this->isTypeName($type_name)) {
            $this->name = $type_name;
        } else {
            throw new NonExistTypeNameException(sprintf('%s was an incorrect value.', $type_name));
        }
    }

    public function name(): string
    {
        return $this->name;
    }

    private function isTypeName(string $type_name): bool
    {
        return in_array($type_name, self::AVAILABLE_TYPE_LIST, true);
    }
}