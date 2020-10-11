<?php

namespace App\Domain;

use PHPUnit\Framework\TestCase;

class PokemonTest extends TestCase
{
    public function test__construct_ポケモンには名前とタイプがある()
    {
        $this->assertInstanceOf(Pokemon::class, new Pokemon('ホルード', new Type('normal'), new Type('ground')));
    }

    public function test__construct_名前の無いポケモンはいない()
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('No name is set.');
        new Pokemon('', new Type('normal'));
    }

    public function test__construct_同じタイプを複数設定できない()
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Same type cannot be set.');
        new Pokemon('ホルード',new Type('normal'), new Type('normal'));
    }

    public function test__construct_タイプは最大2つまで()
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Too many types set.');
        new Pokemon('ホルード', new Type('normal'), new Type('ground'), new Type('water'));
    }

    public function testGetter()
    {
        $type_1 = new Type('normal');
        $type_2 = new Type('ground');
        $pokemon = new Pokemon('ホルード', $type_1, $type_2);
        $this->assertSame('ホルード', $pokemon->name());
        $this->assertSame([$type_1, $type_2], $pokemon->types());
    }

}