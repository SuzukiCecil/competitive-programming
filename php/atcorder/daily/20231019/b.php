<?php
/**
 * B - camel Case
 * https://atcoder.jp/contests/adt_all_20231019_2/tasks/abc291_a
 * <問題文>
 * 英大文字および英小文字からなる文字列S が与えられます。
 * ここで、S のうちちょうど1 文字だけが英大文字であり、それ以外は全て英小文字です。
 * 大文字がS の先頭から何文字目に登場するか出力してください。
 * ただし、S の先頭の文字を1 文字目とします。
 *
 * <メモ>
 * 文字列には必ず大文字が1文字以上含まれるため、1文字目から最初の大文字が現れる文字まで探索するのみ
 */
$init = function () {
    list($s) = explode(" ", trim(fgets(STDIN)));
    return [$s];
};

list($s) = $init();

$i = 0;
while (true) {
    if ($s[$i] >= "A" && $s[$i] <= "Z") {
        echo $i + 1 . "\n";
        exit;
    }
    $i++;
}