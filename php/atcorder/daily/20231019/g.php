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
    $graph = [];
    for ($i = 0; $i < $m; $i++) {
        $k = trim(fgets(STDIN));
        $balls = explode(" ", trim(fgets(STDIN)));
        for ($j = 1; $j < $k; $j++) {
            for ($l = 0; $l < $j; $l++) {
                $graph[] = [(int)$balls[$j] - 1, (int)$balls[$l] - 1];
            }
        }
    }
    $isVisited = array_fill(0, $n, false);
    return [(int)$n, (int)$m, $graph, $isVisited];
};

list($n, $m, $graph, $isVisited) = $init();

$visit = function (int $start, int $position) use (&$visit, &$isVisited, $graph) {
    $isVisited[$position] = true;
    foreach ($graph as $key => $node) {
        if ($node[0] === $position && $node[1] === $start) {
            echo "No\n";
            exit;
        } elseif ($node[0] === $position && !$isVisited[$node[1]]) {
            unset($graph[$key]);
            $visit($start, $node[1]);
        }
    }
};

for ($i = 0; $i < $n; $i++) {
    if (!$isVisited[$i]) {
        $visit($i, $i);
    }
}
echo "Yes\n";
