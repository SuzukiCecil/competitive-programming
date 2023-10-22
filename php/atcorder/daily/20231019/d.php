<?php
/**
 * D - Explore
 * https://atcoder.jp/contests/adt_all_20231019_2/tasks/abc265_b
 * <問題文>
 * 高橋君はゲームの中で洞窟を探索しています。
 *
 * 洞窟はN 個の部屋が一列に並んだ構造であり、入り口から順に部屋1,2,…,N と番号がついています。
 * 最初、高橋君は部屋1 におり、持ち時間 はT です。
 * 各1≤i≤N−1 について、持ち時間をAi消費することで、部屋i から部屋i+1 へ移動することができます。
 * これ以外に部屋を移動する方法はありません。 また、持ち時間が0 以下になるような移動は行うことができません。
 *
 * 洞窟内にはM 個のボーナス部屋があります。i 番目のボーナス部屋は部屋Xiであり、この部屋に到達すると持ち時間がYi増加します。
 *
 * 高橋君は部屋N にたどりつくことができますか？
 *
 * <メモ>
 * 先頭からシミュレーションするのみ。
 * なお入力を以下変数に置き換えている
 * $t：現在の持ち時間
 * $rooms：部屋iで消費する時間の配列
 * $restRooms：部屋iで回復する時間の配列
 */
$init = function () {
    list($n, $m, $t) = explode(" ", trim(fgets(STDIN)));
    $rooms = explode(" ", trim(fgets(STDIN)));
    $restRooms = [];
    for ($i = 0; $i < $m; $i++) {
        list($x, $y) = explode(" ", trim(fgets(STDIN)));
        $restRooms[$x - 1] = $y;
    }
    return [(int)$t, $rooms, $restRooms];
};

list($t, $rooms, $restRooms) = $init();

for ($i = 0; isset($rooms[$i]); $i++) {
    if (isset($restRooms[$i])) {
        $t += $restRooms[$i];
    }
    if ($t - $rooms[$i] <= 0) {
        echo "No\n";
        exit;
    }
    $t -= $rooms[$i];
}
echo "Yes\n";
