<?php
/**
 * E - Calendar Validator
 * https://atcoder.jp/contests/adt_all_20231024_2/tasks/abc225_c
 * <問題文>
 * 10^100行 7 列の行列 A があり、任意の整数対 (i,j) (1≤i ≤10^100,1≤j≤7) についてその (i,j) 成分は (i−1)×7+j です。
 * N 行 M 列の行列 B が与えられるので、B が A から一部の矩形領域を（向きを変えずに）切り出したものであるかを判定してください。
 *
 * <メモ>
 * 以下のいずれかでも満たしていなければNo
 * ・1行目が連番になっていない
 * ・いずれかの列が7飛びになっていない
 * ・7 8のように改行されるべき箇所が1行目に含まれている
 */

$init = function () {
    list($n, $m) = explode(" ", trim(fgets(STDIN)));
    $calendar = [];
    for ($i = 0; $i < $n; $i++) {
        $calendar[] = explode(" ", trim(fgets(STDIN)));
    }
    return [$n, $m, $calendar];
};

list($n, $m, $calendar) = $init();

for ($j = 0; $j < $m; $j++) {
    if ($calendar[0][$j] % 7 == 0 && $j != $m - 1) {
        echo "No\n";
        exit;
    }
    if (isset($calendar[0][$j - 1]) && $calendar[0][$j] - $calendar[0][$j - 1] != 1) {
        echo "No\n";
        exit;
    }
    for ($i = 0; $i < $n; $i++) {
        if (isset($calendar[$i - 1][$j]) && $calendar[$i][$j] - $calendar[$i - 1][$j] != 7) {
            echo "No\n";
            exit;
        }
    }
}
echo "Yes\n";
