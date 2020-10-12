<?php


namespace App;


use App\Domain\CompatibilityBuilder;
use App\Domain\PokemonBuilder;
use App\Infrastructure\TypeList;
use App\Presenter\PokemonComplementCompatibilityDisplay;

class UsecaseComplementCompatibility
{
    public function execute(array $pokemon_types, TypeList $type_list): PokemonComplementCompatibilityDisplay
    {
        // ポケモン情報を受取る
        $pokemon = (new PokemonBuilder())->build('dummy', $pokemon_types);

        $compatibility = (new CompatibilityBuilder())->build($type_list, $pokemon);

        // にがてなタイプを列挙

        // にがてなタイプに耐性のあるタイプの候補を出す

        // ポケモン名と相性の出力機を返す
        return new PokemonComplementCompatibilityDisplay($pokemon, $compatibility);
    }
}