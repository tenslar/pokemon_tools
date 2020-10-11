<?php

namespace App\Domain;

use PHPUnit\Framework\TestCase;

class TypeTest extends TestCase
{
    public function test__construct_タイプを生成できる()
    {
        $this->assertInstanceOf(Type::class, new Type('normal'));
    }

    public function test__construct_存在しないタイプ名を指定するとエラー()
    {
        $this->expectException(NonExistTypeNameException::class);
        $invalid_type_name = 'hogehoge';
        $this->expectExceptionMessage(sprintf('%s was an incorrect value.', $invalid_type_name));
        new Type($invalid_type_name);
    }

    public function testGetter()
    {
        $type = new Type('normal');
        $this->assertSame('normal', $type->Name());
    }
}
