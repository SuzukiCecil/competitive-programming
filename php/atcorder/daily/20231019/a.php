<?php
/**
 * A - Tires
 * https://atcoder.jp/contests/adt_all_20231019_2/tasks/abc224_a
 * <問題文>
 * 末尾が er または ist であるような文字列S が与えられます。
 * S の末尾が er である場合は er を、 ist である場合は ist を出力してください。
 *
 * <メモ>
 * 文字列は末尾がer, istのどちらかのみのため一方の判定のみを行えばいい
 * 末尾からの文字は負の配列の要素で取得できる
 */
$init = function () {
    list($s) = explode(" ", trim(fgets(STDIN)));
    return [$s];
};

list($s) = $init();

if ($s[-2] === "e" && $s[-1] === "r") {
    echo "er\n";
} else {
    echo "ist\n";
}