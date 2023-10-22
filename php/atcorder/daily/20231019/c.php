<?php
/**
 * C - Perfect String
 * https://atcoder.jp/contests/adt_all_20231019_2/tasks/abc249_b
 * <問題文>
 * 英大文字と英小文字からなる文字列のうち、以下の条件を全て満たすものを素晴らしい文字列ということとします。
 *  英大文字が文字列の中に現れる。
 *  英小文字が文字列の中に現れる。
 *  全ての文字が相異なる。
 * 例えば、AtCoder や Aa は素晴らしい文字列ですが、atcoder や Perfect は素晴らしい文字列ではありません。
 *
 * 文字列S が与えられるので、S が素晴らしい文字列か判定してください。
 *
 * <メモ>
 * 探索の終了はissetで判定。
 * 大文字、小文字それぞれで文字数マッパーを作成し、1文字でもカウントが2以上になれば素晴らしい文字列ではない。
 * 全ての文字のカウントが1以下かつ、それぞれのマッパーでカウントが1以上の文字があれば素晴らしい文字列。
 */
$init = function () {
    list($s) = explode(" ", trim(fgets(STDIN)));
    return [$s];
};

list($s) = $init();

$largeCount = array_fill(0, 26, 0);
$smallCount = array_fill(0, 26, 0);

for ($i = 0; isset($s[$i]); $i++) {
    if ($s[$i] >= "A" && $s[$i] <= "Z") {
        $index = ord($s[$i]) - ord("A");
        $largeCount[$index]++;
        if ($largeCount[$index] > 1) {
            echo "No\n";
            exit;
        }
    } else {
        $index = ord($s[$i]) - ord("a");
        $smallCount[$index]++;
        if ($smallCount[$index] > 1) {
            echo "No\n";
            exit;
        }
    }
}

if (count(array_filter($largeCount)) > 0 && count(array_filter($smallCount)) > 0) {
    echo "Yes\n";
    exit;
}
echo "No\n";
