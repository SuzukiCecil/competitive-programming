<?php
/**
 * F - Count Connected Components
 * https://atcoder.jp/contests/adt_all_20231019_2/tasks/abc284_c
 * <問題文>
 * 頂点に1 からN の番号が、辺に1 からM の番号がついたN 頂点M 辺の単純無向グラフが与えられます。
 * 辺i は頂点uiと頂点viを結んでいます。
 * グラフに含まれる連結成分の個数を求めてください。
 *
 * <メモ>
 * 頂点1から頂点Nまで繰り返し頂点iがまだ探索済みでない場合カウントをインクリメントして以下探索を行う
 * ・頂点iを探索済みとする
 * ・頂点iから頂点jへ探索でき、かつ頂点jがまだ探索済みでない場合は探索を頂点jへ移す
 *
 * 探索はdfsでもbfsでもどちらでも問題ないためdfsを採用
 */
$init = function () {
    list($n, $m) = explode(" ", trim(fgets(STDIN)));
    $lines = [];
    for ($i = 0; $i < $m; $i++) {
        list($u, $v) = explode(" ", trim(fgets(STDIN)));
        $lines[] = [(int)$u - 1, (int)$v - 1];
    }
    $isVisited = [];
    for ($i = 0; $i < $n; $i++) {
        $isVisited[$i] = false;
    }
    return [(int)$n, (int)$m, $lines, $isVisited];
};

list($n, $m, $lines, $isVisited) = $init();

$visit = function (int $point) use (&$visit, $lines, &$isVisited) {
    $isVisited[$point] = true;
    foreach ($lines as $line) {
        if ($point === $line[0] && !$isVisited[$line[1]]) {
            $visit($line[1]);
        }
        if ($point === $line[1] && !$isVisited[$line[0]]) {
            $visit($line[0]);
        }
    }
};

$answer = 0;
for ($i = 0; $i < $n; $i++) {
    if (!$isVisited[$i]) {
        $answer++;
        $visit($i);
    }
}
echo $answer . "\n";
