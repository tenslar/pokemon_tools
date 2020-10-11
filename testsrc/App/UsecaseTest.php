<?php

namespace App;

use App\Presenter\PokemonCompatibilityDisplay;
use PHPUnit\Framework\TestCase;

class UsecaseTest extends TestCase
{

    public function testExecute()
    {
        $usecase = new Usecase();
        $this->assertInstanceOf(PokemonCompatibilityDisplay::class,
            $usecase->execute('ホルード', ['normal', 'ground'], __DIR__.'/type_list.json'
            ));
    }
}
