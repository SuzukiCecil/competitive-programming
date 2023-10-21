<?php
/**
 * G - Trophy
 * https://atcoder.jp/contests/adt_hard_20231018_2/tasks/abc258_d
 * <問題文>
 * 合計X 回ステージをクリアするために必要な時間の最小値を求めてください。ただし、同じステージを複数回クリアしたとしても、全てクリア回数に数えられます。
 *
 * <メモ>
 * 必要なクリア数（x）がステージ数（n）よりも大きい場合、いずれかのステージをひたすら繰り返すのが最短時間となる。
 * 次の通り変数を定義する
 *   ・i本目のステージを最初にクリアするのに要する時間の配列：$firstClearTimes
 *   ・i本目のステージを繰り返して必要なクリア数に達するのに要する時間の配列：$clearTimes
 *
 * 以下の通りシミュレーションを行う
 * 0 ... min(n, x)だけiを繰り返す
 * ・iが0の場合：$firstClearTimes[0]は$stage[0][0] + $stage[0][1]となる
 * ・iが0より大きい場合：$firstClearTimes[$i]は$firstClearTimes[$i - 1] + $stage[0][0] + $stage[0][1]となる
 * ・i本目のゲームに達するのにiステージクリアしているので、残りクリア数は x - iとなる。
 * ・i本目のゲームを繰り返して必要なクリア数に達するためには、残りクリア数 * $stage[0][1]時間 だけ時間を要する
 * ・i本目のゲームに到達するのに$firstClearTimes[$i]時間要しているため、$clearTimes[$i]は $firstClearTimes[$i] + 残りクリア数 * $stage[0][1]時間ということになる
 * ・あとは$clearTimesの要素のうち最小の値が答えとなる
 */
$init = function () {
    list($n, $x) = explode(" ", trim(fgets(STDIN)));
    $stages = [];
    for ($i = 0; $i < $n; $i++) {
        list($a, $b) = explode(" ", trim(fgets(STDIN)));
        $stages[] = [(int)$a, (int)$b];
    }
    return [(int)$n, (int)$x, $stages];
};

list($n, $x, $stages) = $init();

$clearTimes = [];
$firstClearTimes = [];
for ($i = 0; $i < min($n, $x); $i++) {
    $firstClearTimes[$i] = (isset($firstClearTimes[$i - 1]) ? $firstClearTimes[$i - 1] : 0) + $stages[$i][0] + $stages[$i][1];
    $clearTimes[$i] = $firstClearTimes[$i] + (max($x - ($i + 1), 0) * $stages[$i][1]);
}

echo min($clearTimes) . "\n";
