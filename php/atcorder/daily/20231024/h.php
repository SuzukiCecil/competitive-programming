<?php
/**
 * 【未解決】
 * H - Isolation
 * https://atcoder.jp/contests/adt_all_20231024_2/tasks/abc302_e
 * <問題文>
 * 最初 N 頂点 0 辺の無向グラフがあり、各頂点には 1 から N まで番号がついています。
 * Q 個のクエリが与えられるので、順に処理し、各クエリの後における「他のどの頂点とも辺で結ばれていない頂点」の数を出力してください。
 *
 * <メモ>
 * アルゴリズムとしては合っていると思うがPHPだと厳しいかTLEとなってしまう
 */

list($n, $q) = explode(" ", trim(fgets(STDIN)));

$answer = $n;

$mappers = array_fill(0, $n + 1, []);

for ($i = 0; $i < $q; $i++) {
    $query = explode(" ", trim(fgets(STDIN)));
    if ($query[0] == 1) {
        if (count($mappers[$query[1]]) === 0) {
            $answer--;
        }
        if (count($mappers[$query[2]]) === 0) {
            $answer--;
        }
        $mappers[$query[1]][] = $query[2];
        $mappers[$query[2]][] = $query[1];
    } else {
        if (count($mappers[$query[1]]) > 0) {
            $mappers[$query[1]] = [];
            $answer++;
        }
        for ($j = 0; $j <= $n; $j++) {
            if (in_array($query[1], $mappers[$j])) {
                $mappers[$j] = array_diff($mappers[$j], [$query[1]]);
                if (count($mappers[$j]) === 0) {
                    $answer++;
                }
            }
        }
    }
    echo $answer . "\n";
}
