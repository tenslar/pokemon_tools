<?php

namespace App\Infrastructure;

use PHPUnit\Framework\TestCase;

class TypeListTest extends TestCase
{

    const TEST_PATH = __DIR__.'/type_list.json';
    const TEST_TYPE_INFO = [
        'immunes' => ['ghost'],
        'weaknesses' => ['fighting', 'rock'],
        'strengths' => [],
    ];

    public function test__construct_インスタンスを取得できる()
    {
        $type_list = new TypeList(self::TEST_PATH);
        $this->assertInstanceOf(TypeList::class, $type_list, 'TypeListインスタンスを取得できる');
    }

    public function test__construct_ファイルが存在しなければ例外を返す()
    {
        $this->expectException(FileNotFoundException::class);
        new TypeList('/invalid/_path');
    }

    public function test__construct_ファイルが読み込めなければ例外を返す()
    {
        $this->expectException(UnreadJsonException::class);
        new TypeList(__DIR__.'/bad_type_list.json');
    }

    public function testGetType_指定タイプの相性データ配列を取得できる()
    {
        $type_list = new TypeList(self::TEST_PATH);
        $normal_type_info = $type_list->getType('normal');
        $this->assertSame(self::TEST_TYPE_INFO, $normal_type_info);
    }

    public function testGetType_存在しない相性データを取得すると空配列を取得できる()
    {
        $type_list = new TypeList(self::TEST_PATH);
        $normal_type_info = $type_list->getType('non_exist_type');
        $this->assertSame([], $normal_type_info);
    }
}
