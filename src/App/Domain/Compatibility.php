<?php

namespace App\Domain;

class Compatibility
{
    const BASE_COMPATIBILITY_MAP = [
        'normal' => 1.0,
        'fire' => 1.0,
        'water' => 1.0,
        'electric' => 1.0,
        'grass' => 1.0,
        'ice' => 1.0,
        'fighting' => 1.0,
        'poison' => 1.0,
        'ground' => 1.0,
        'flying' => 1.0,
        'psychic' => 1.0,
        'bug' => 1.0,
        'rock' => 1.0,
        'ghost' => 1.0,
        'dragon' => 1.0,
        'dark' => 1.0,
        'steel' => 1.0,
        'fairy' => 1.0,
    ];

    public static function combine(Compatibility $target1, Compatibility $target2): self
    {
        $combined_map = [];
        $target1_map = $target1->map();
        $target2_map = $target2->map();

        foreach (self::BASE_COMPATIBILITY_MAP as $type => $factor) {
            $combined_map[$type] = $target1_map[$type] * $target2_map[$type];
        }
        return new Compatibility($combined_map);
    }
    public static function make($immunes, $weaknesses, $strengths): self
    {
        $compatibility_map = self::BASE_COMPATIBILITY_MAP;

        foreach ($immunes as $immune) {
            $compatibility_map[$immune] = 0.0;
        }

        foreach ($weaknesses as $weakness) {
            $compatibility_map[$weakness] = 2.0;
        }

        foreach ($strengths as $strength) {
            $compatibility_map[$strength] = 0.5;
        }

        return new Compatibility($compatibility_map);
    }

    private $map;

    public function __construct(array $map)
    {
        $require_types = array_keys(self::BASE_COMPATIBILITY_MAP);
        $types_into_map = array_keys($map);
        sort($require_types);
        sort($types_into_map);

        if ($require_types !== $types_into_map) {
            throw new \RuntimeException(sprintf('Anomalous compatibility data.'));
        }

        $this->map = $map;
    }

    public function map(): array{
        return $this->map;
    }
}