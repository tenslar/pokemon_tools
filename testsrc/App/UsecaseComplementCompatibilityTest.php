<?php

namespace App;

use App\Infrastructure\TypeList;
use App\Presenter\PokemonComplementCompatibilityDisplay;
use PHPUnit\Framework\TestCase;

class UsecaseComplementCompatibilityTest extends TestCase
{

    public function testExecute()
    {
        $usecase = new UsecaseComplementCompatibility();
        $type_list = new TypeList(__DIR__ . '/type_list.json');
        $this->assertInstanceOf(PokemonComplementCompatibilityDisplay::class,
            $usecase->execute(['normal', 'ground'], $type_list));
    }
}
