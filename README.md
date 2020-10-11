# PokemonTools: Pokémon battle support tools

PokemonTools is a some calculating tools you need to make a strong Pokémon.
It is created in simple PHP.

## Demo

```sh
# Displaying Pokémon compatibility
$ php index.php
Pikachu electric # input poke_name and poke_type
名前：Pikachu
タイプ：electric
相性：
ground:x2
electric:x0.5
flying:x0.5
steel:x0.5
```

## Feature

- Displaying Pokémon compatibility
- Coming soon...

## Requirements

- [PHP7.3](https://www.php.net/downloads) or higher
- [Composer](https://getcomposer.org/)
- [PHPUnit9.4.*](https://packagist.org/packages/phpunit/phpunit)

## Installation

Install [HHVM](https://docs.hhvm.com/hhvm/installation/introduction#prebuilt-packages).

Clone this repository, And Composer install.
```sh
$ git clone git@github.com:tenslar/pokemon_tools.git
$ composer install
```

## Usage

For now, the only function is to display your Pokémon's affinity.

Run index.php and enter your Pokémon's name and type. You will then see the Pokémon's affinity.

```sh
$ php index.php
Pikachu electric # input poke_name and poke_type
名前：Pikachu
タイプ：electric
相性：
ground:x2
electric:x0.5
flying:x0.5
steel:x0.5
```
