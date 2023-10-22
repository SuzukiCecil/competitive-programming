<?php
/**
 * D - Explore
 * https://atcoder.jp/contests/adt_all_20231019_2/tasks/abc265_b
 * <問題文>
 * 長さN の非負整数列A=(A1,A2,…,AN) が与えられます。
 * A の異なる2 要素の和として表せる値の中に偶数が存在するか判定し、存在する場合その最大値を求めてください。
 *
 * <メモ>
 * 2要素の和が偶数になるのは奇数,奇数もしくは偶数,偶数の組み合わせのみ
 * 非負整数列Aを偶数数列と奇数数列に分けて以下判定を行う
 * ・偶数数列、奇数数列ともに要素数が2以上の場合：偶数数列の最大値2つの和と奇数数列の最大値2つの和の大きい方を出力
 * ・偶数数列の要素数が2以上の場合：偶数数列の最大値2つの和を出力
 * ・奇数数列の要素数が2以上の場合：奇数数列の最大値2つの和を出力
 * ・偶数数列、奇数数列ともに要素数が2未満の場合：-1を出力
 */
$init = function () {
    list($n) = explode(" ", trim(fgets(STDIN)));
    $numbers = explode(" ", trim(fgets(STDIN)));
    $evenNumbers = [];
    $oddNumbers = [];
    for ($i = 0; $i < $n; $i++) {
        if ($numbers[$i] % 2 === 0) {
            $evenNumbers[] = (int)$numbers[$i];
        } else {
            $oddNumbers[] = (int)$numbers[$i];
        }
    }
    rsort($evenNumbers);
    rsort($oddNumbers);
    return [$evenNumbers, $oddNumbers];
};

list($evenNumbers, $oddNumbers) = $init();

if (count($evenNumbers) >= 2 && count($oddNumbers) >= 2) {
    echo max($oddNumbers[0] + $oddNumbers[1], $evenNumbers[0] + $evenNumbers[1]) . "\n";
} elseif (count($evenNumbers) >= 2) {
    echo $evenNumbers[0] + $evenNumbers[1] . "\n";
} elseif (count($oddNumbers) >= 2) {
    echo $oddNumbers[0] + $oddNumbers[1] . "\n";
} else {
    echo "-1\n";
}