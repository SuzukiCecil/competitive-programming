<?php
/**
 * E - kasaka
 * https://atcoder.jp/contests/adt_hard_20231018_2/tasks/abc237_c
 * <問題文>
 * 英小文字からなる文字列S が与えられます。
 * S の先頭に a をいくつか（0 個でも良い）つけ加えて回文にすることができるか判定してください。
 *
 * <メモ>
 * 回文判定にはstrrevを用いれば判定できる。
 * 先頭に a を付け加えて回文にするということは末尾のaを取り除いて回文にできるかを判定すれば良いと考えた。
 * しかし、 akasaka のように末尾がaかつaを加えずに回文に出来る文字列の判定に関して、akasak となってしまい回文判定が出来なかった。
 * 次に 末尾だけでなく先頭からもaを取り除いて回文に出来るかを判定しようとしたら aakasaka のように 末尾より先頭の a の文字数が多い文字列を回文判定してしまい、こちらも回文判定が正しくなかった。
 * そのため、末尾より先頭の a の文字数が多い文字列の場合は回文でないものとし、その上で末尾と先頭のaを取り除いて回文判定したところ判定が正しくなった。
 */

list($s) = explode(" ", trim(fgets(STDIN)));

$start = 0;
$end = 0;
for ($i = 0; $i < strlen($s); $i++) {
    if ($s[$i] === "a") {
        $start++;
    } else {
        break;
    }
}
for ($i = strlen($s) - 1; $i >= 0 ; $i --) {
    if ($s[$i] === "a") {
        $end++;
    } else {
        break;
    }
}

if ($start > $end) {
    echo "No\n";
    exit;
}

if (trim($s, "a") === strrev(trim($s, "a"))) {
    echo "Yes\n";
    exit;
}

echo "No\n";
exit;
