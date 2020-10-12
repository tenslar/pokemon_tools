<?php


namespace App\Presenter;


use App\Domain\Compatibility;
use App\Domain\Pokemon;

class PokemonComplementCompatibilityDisplay
{
    private $pokemon;
    private $compatibility;

    public function __construct(Pokemon $pokemon, Compatibility $compatibility)
    {
        $this->pokemon = $pokemon;
        $this->compatibility = $compatibility;
    }

    public function show()
    {
        $display = <<<DISP
名前：{$this->pokemon->name()}
タイプ：{$this->pokemonTypes()}
相性：
{$this->pokemonAbnormalCompatibility()}
{$this->pokemonComplementCompatibility()}

DISP;
        print($display);
    }

    private function pokemonTypes()
    {
        $types = [];
        foreach ($this->pokemon->types() as $type) {
            $types[] .= $type->name();
        }
        return implode(',', $types);
    }

    private function pokemonAbnormalCompatibility()
    {
        // とうばい以外の相性を抽出
        $abnormal_compatibility = [];
        foreach ($this->compatibility->map() as $type => $factor) {
            if ($factor == 1) continue;

            $abnormal_compatibility[$type] = $factor;
        }

        // ばつぐん>いまひとつ>むこう の順番に表示する
        arsort($abnormal_compatibility);

        // 相性情報をテキストに変換
        $text_compatibility = [];
        foreach ($abnormal_compatibility as $type => $factor) {
            $text_compatibility[] = sprintf('%s:x%s', $type, $factor);
        }

        return implode(PHP_EOL, $text_compatibility);
    }

    private function pokemonComplementCompatibility()
    {
    }
}