<?php

namespace App;

use App\Domain\CompatibilityBuilder;
use App\Domain\PokemonBuilder;
use App\Infrastructure\TypeList;
use App\Presenter\PokemonCompatibilityDisplay;

class Usecase
{
    public function execute(string $pokemon_name, array $pokemon_types, $type_data_path): PokemonCompatibilityDisplay
    {
        // ポケモン情報を受取る
        $pokemon = (new PokemonBuilder())->build($pokemon_name, $pokemon_types);

        $type_list = new TypeList($type_data_path);
        $compatibility = (new CompatibilityBuilder())->build($type_list, $pokemon);

        // ポケモン名と相性の出力機を返す
        return new PokemonCompatibilityDisplay($pokemon, $compatibility);
    }

}