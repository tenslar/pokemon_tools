<?php

namespace App\Domain;

use PHPUnit\Framework\TestCase;

class CompatibilityTest extends TestCase
{
    const TEST_COMPATIBILITY_MAP = [
        'normal' => 1.0,
        'fire' => 2.0,
        'water' => 0.5,
        'electric' => 0.0,
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

    public function test__construct_相性表から相性オブジェクトを作成できる()
    {
        $this->assertInstanceOf(Compatibility::class, new Compatibility(self::TEST_COMPATIBILITY_MAP));
    }

    public function test__construct_相性表は全タイプのデータが無いとエラー()
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Anomalous compatibility data.');
        $not_enough_compatibility_data = ['normal' => 1.0];
        new Compatibility($not_enough_compatibility_data);
    }

    public function test_map_相性表を取り出せる()
    {
        $compatibility = new Compatibility(self::TEST_COMPATIBILITY_MAP);
        $this->assertSame(self::TEST_COMPATIBILITY_MAP, $compatibility->map());
    }

    public function test_make_無効、弱点、耐性データから相性表を作成し、オブジェクト化できる()
    {
        $compatibility = Compatibility::make(['electric'], ['fire'], ['water']);
        $this->assertSame(self::TEST_COMPATIBILITY_MAP, $compatibility->map());
    }

    public function test_combine_相性は複合出来る()
    {
        $compatibility1 = Compatibility::make(['electric'], ['fire', 'ice'], ['water', 'grass']);
        $compatibility2 = Compatibility::make(['water'], ['fire'], ['grass', 'ice']);
        $combined_compatibility = Compatibility::combine($compatibility1, $compatibility2);

        $expect = [
            'normal' => 1.0,
            'fire' => 4.0, // weaknesses and weaknesses
            'water' => 0.0, // any and immunes
            'electric' => 0.0,
            'grass' => 0.25, // strengths and strengths
            'ice' => 1.0, // weaknesses and strengths
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
        $this->assertSame($expect, $combined_compatibility->map());
    }
}
