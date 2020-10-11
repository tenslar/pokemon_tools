<?php


namespace App\Domain;


class PokemonBuilder
{
    public function build(string $name, array $types): Pokemon {
        if (count($types) > 1) {
            return new Pokemon($name, new Type($types[0]), new Type($types[1]));
        }
        return new Pokemon($name, new Type($types[0]));
    }
}