<?php
/**
 * 【未解決】
 * G - Add One Edge
 * https://atcoder.jp/contests/adt_all_20231024_2/tasks/abc309_d
 * <問題文>
 * 長いので要約
 * 全てのノードが連結している無向グラフA,Bが与えられる（A,Bは連結していない）
 * グラフAのノードは 1 ~ N1、グラフBのノードは N1 ~ N1+N2
 * ノード1からノードN1+N2までの最短距離が最大となるようにAのいずれかのノードとBのいずれかのノードを結ぶ辺を加えると最大値は幾つになるか
 *
 * <メモ>
 * グラフAの全てのノードにおいてノード1からの最短距離を求める
 * グラフBの全てのノードにおいてノードN1+N2からの最短距離を求める
 * グラフAにおける最短距離の最大値、グラフBにおける最短距離の最大値、1（新たに追加する辺の距離分）を加算した結果が答えとなる
 * アルゴリズムとしては合っていると思うがPHPだと厳しいかTLEとなってしまう
 */

$init = function () {
    list($n1, $n2, $m) = explode(" ", trim(fgets(STDIN)));

    $edges1 = [];
    $edges2 = [];
    for ($i = 0; $i < $m; $i++) {
        list($a, $b) = explode(" ", trim(fgets(STDIN)));
        if ($a <= $n1) {
            $edges1[] = [(int)$a - 1, (int)$b - 1];
        } else {
            $edges2[] = [(int)$a - 1, (int)$b - 1];
        }
    }

    return [(int)$n1, (int)$n2, (int)$m, $edges1, $edges2];
};

list($n1, $n2, $m, $edges1, $edges2) = $init();

$visit = function ($edges, $minNode, $nodeCount, $startPosition): int {
    $isVisited = array_fill($minNode, $nodeCount, false);
    $isVisited[$startPosition] = true;
    $queue[] = [
        "position" => $startPosition,
        "dist" => 0
    ];

    while (true) {
        $current = array_shift($queue);
        foreach ($edges as $key => $edge) {
            if ($edge[0] === $current["position"]) {
                if (!$isVisited[$edge[1]]) {
                    $queue[] = [
                        "position" => $edge[1],
                        "dist" => $current["dist"] + 1,
                    ];
                    $isVisited[$edge[1]] = true;
                }
                unset($edges[$key]);
            } elseif ($edge[1] === $current["position"]) {
                if (!$isVisited[$edge[0]]) {
                    $queue[] = [
                        "position" => $edge[0],
                        "dist" => $current["dist"] + 1,
                    ];
                    $isVisited[$edge[0]] = true;
                }
                unset($edges[$key]);
            }
        }

        if (count($queue) === 0) {
            return $current["dist"];
        }
    }
};
echo $visit($edges1, 0, $n1, 0) + $visit($edges2, $n1, $n2, $n1 + $n2 - 1) + 1 . "\n";
