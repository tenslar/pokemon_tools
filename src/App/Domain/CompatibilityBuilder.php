<?php

namespace App\Domain;

use App\Infrastructure\TypeList;

class CompatibilityBuilder
{

    public function build(TypeList $type_list, Pokemon $pokemon): Compatibility
    {
        $types = $pokemon->types();
        $types_info = array_map(function (Type $type) use ($type_list) {
            return $type_list->getType($type->name());
        }, $types);

        $first_type = 0;
        $compatibility = $this->makeCompatibility($types[$first_type], $type_list);

        if (count($types) === 2) {
            $second_type = 1;
            $compatibility_B = $this->makeCompatibility($types[$second_type], $type_list);
            $compatibility = Compatibility::combine($compatibility, $compatibility_B);
        }

        return $compatibility;
    }

    private function makeCompatibility(Type $type, TypeList $type_list): Compatibility
    {
        $info = $type_list->getType($type->name());
        $immunes = $info['immunes'];
        $weaknesses = $info['weaknesses'];
        $strengths = $info['strengths'];

        return Compatibility::make($immunes, $weaknesses, $strengths);
    }
}