<?php

namespace App;

use App\Presenter\PokemonCompatibilityDisplay;
use PHPUnit\Framework\TestCase;

class UsecaseCompatibilityTest extends TestCase
{

    public function testExecute()
    {
        $usecase = new UsecaseCompatibility();
        $this->assertInstanceOf(PokemonCompatibilityDisplay::class,
            $usecase->execute('ホルード', ['normal', 'ground'], __DIR__ . '/type_list.json'
            ));
    }
}
