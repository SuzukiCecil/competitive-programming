<?php
/**
 * F - Doukasen
 * https://atcoder.jp/contests/adt_hard_20231018_2/tasks/abc223_c
 * <問題文>
 * この導火線の左端と右端から同時に火をつけるとき、
 * 2 つの火がぶつかる場所が着火前の導火線の左端から何 cm の地点か求めてください。
 *
 * <メモ>
 * 2つの火がぶつかる場所というのは0本目から燃焼を開始させて【全体の燃焼時間 / 2】時間経過した地点を指す。
 * そのため右端（n本目）からの燃焼のシミュレーションは不要で0本目からのシミュレーションのみを行えば良い。
 * 次の通り変数を定義する
 *  ・【全体の燃焼時間 / 2】：$halfTime
 *  ・i本目の導火線時点での燃焼距離：$burnedDistance
 *  ・i本目の導火線時点での燃焼時間：$burningTime
 *
 * 以下の通りシミュレーションを行う
 * ・i本目の導火線に置いて$burningTimeが$halfTimeを超過しない場合
 *      ・i本目の導火線が燃焼し切った時点で半分に到達していないため、$burnedDistanceにi本目の導火線の長さを加算する
 * ・i本目の導火線に置いて$burningTimeが$halfTimeを超過する場合
 *      ・i本目の導火線が燃焼し切る前（もしくは燃焼し切ったタイミング）で半分に到達する
 *      ・そのため、$burnedDistanceに残り時間【$halfTime - $burningTime】とi本目の導火線が1秒あたり燃焼する距離の積を加算してシミュレーションを終了する
 * シミュレーションを終了した時の$burnedDistanceが答えとなる
 */
$init = function () {
    list($n) = explode(" ", trim(fgets(STDIN)));
    $fusees = [];
    for ($i = 0; $i < $n; $i++) {
        list($a, $b) = explode(" ", trim(fgets(STDIN)));
        $fusees[] = [(int)$a, (int)$b];
    }
    return [$n, $fusees];
};

list($n, $fusees) = $init();

/** @var float $finishedTime 導火線全体が燃焼するのに必要とする時間 */
$finishedTime = array_reduce($fusees, function ($time, array $fuse) {
    return $time + $fuse[0] / $fuse[1];
}, 0.0);
/** @var float $halfTime 導火線の半分が燃焼するのに必要とする時間（0本目、i本目それぞれ燃焼させた時に燃焼が重なる際の時間） */
$halfTime = $finishedTime / 2;
/** @var int $burnedDistance i - 1本目の導火線が燃焼し切った時の燃焼距離 */
$burnedDistance = 0;
/** @var int $burnedDistance i - 1本目の導火線が燃焼し切った時の燃焼時間 */
$burningTime = 0;
foreach ($fusees as $fuse) {
    if ($burningTime + $fuse[0] / $fuse[1] > $halfTime) {
        $burnedDistance += ($halfTime - $burningTime) * $fuse[1];
        break;
    }
    $burningTime += $fuse[0] / $fuse[1];
    $burnedDistance += $fuse[0];
}
echo $burnedDistance . "\n";
