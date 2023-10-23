<?php
/**
 * 【未解決】
 * G - Pair of Balls
 * https://atcoder.jp/contests/adt_all_20231019_2/tasks/abc216_d
 * <問題文>
 * 2N 個のボールがあります。各ボールには1 以上N 以下の整数によって表される色が塗られており、各色で塗られたボールはちょうど2 個ずつ存在します。
 *
 * <メモ>
 * 愚直にシミュレーションするのはTLEとなりそう。
 * ボールiを取り出すためにはボールjが取り出されていないといった関係を有向グラフとして表現し、
 * 他のボールに阻害されていないボールを起点にグラフを辿っていき、全てのノードに到達できれば、
 * 全てのボールが取り出せたと判定できると思ったが、うまくいっていない。
 */
$init = function () {
    list($n, $m) = explode(" ", trim(fgets(STDIN)));
    $queues = array_fill(0, $n, []);
    for ($i = 0; $i < $m; $i++) {
        $k = trim(fgets(STDIN));
        $balls = explode(" ", trim(fgets(STDIN)));
        for ($j = (int)$k - 1; $j >= 1; $j--) {
            for ($l = $j - 1; $l >= 0; $l--) {
                if (!in_array((int)$balls[$l] - 1, $queues[(int)$balls[$j] - 1])) {
                    $queues[(int)$balls[$j] - 1][] = (int)$balls[$l] - 1;
                }
            }
        }
    }
    return [(int)$n, (int)$m, $queues];
};

/**
 * @var int $n ボールの数
 * @var int $m 筒の数
 * @var array<int, int[]> $queues キーが取り出すボールの番号、要素がボールを取り出すのを阻害しているボールの番号の配列とする二次元配列
 */
list($n, $m, $queues) = $init();

while (true) {
    /** @var int[] $unsets 取り出すことができるボールの番号の配列 */
    $unsets = array_keys(array_filter($queues, fn(array $waits) => empty($waits)));
    if (count($unsets) === 0) {
        break;
    }

    foreach ($queues as $num => &$waits) {
        if (in_array($num, $unsets)) {
            unset($queues[$num]);
        } else {
            $waits = array_values(array_diff($waits, $unsets));
        }
    }
}

if (count($queues) > 0) {
    echo "No\n";
} else {
    echo "Yes\n";
}
