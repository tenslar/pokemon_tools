<?
require_once "vendor/autoload.php";

$path = __DIR__.'/src/App/Infrastructure/type_list.json';


//1行入力
$single_line_input = trim(fgets(STDIN));
//不要な改行コードを取り除く
$single_line_input = str_replace(array("\r\n","\r","\n"), '', $single_line_input);
//スペースで分解して配列に格納
$array = explode(" ", $single_line_input);

$usecase = new \App\UsecaseCompatibility();
$display = $usecase->execute($array[0], explode(',', $array[1]), $path);
$display->show();