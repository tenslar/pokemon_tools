<?php


namespace App\Infrastructure;


class TypeList
{
    private $type_list;

    public function __construct(string $path)
    {
        if (!file_exists($path)) {
            throw new FileNotFoundException(sprintf('File not found in %s', $path));
        }

        $this->type_list = json_decode(file_get_contents($path), true) ?? [];

        if (!$this->type_list) {
            throw new UnreadJsonException(sprintf('Data cannot read from file: %s', $path));
        }
    }

    public function getType(string $type_name): array
    {
        foreach ($this->type_list as $record) {
            if (strtolower($record['name']) === strtolower($type_name)) {
                return [
                    'immunes' => $record['immunes'],
                    'weaknesses' => $record['weaknesses'],
                    'strengths' => $record['strengths'],
                ];
            }
        }
        return [];
    }
}