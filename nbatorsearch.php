<?php
// elasticsearchに接続準備
require 'vendor/autoload.php';
$hosts = [''];
$client = Elasticsearch\ClientBuilder::create()
                    ->setHosts($hosts) 
                    ->build();        

// パラメータから検索条件を取得
$american = $_GET["american"];
if (isset($american)){
  $match[] = array('match' => array('american' => $american));
};

$thirty_years_over = $_GET["thirty_years_over"];
if (isset($thirty_years_over)){
  $match[] = array('match' => array('thirty_years_over' => $thirty_years_over));
};

$active_player = $_GET["active_player"];
if (isset($active_player)){
  $match[] = array('match' => array('active_player' => $active_player));
};

$height_over_2meters = $_GET["height_over_2meters"];
if (isset($height_over_2meters)){
  $match[] = array('match' => array('height_over_2meters' => $height_over_2meters));
};

$champion = $_GET["champion"];
if (isset($champion)){
  $match[] = array('match' => array('champion' => $champion));
};

$god = $_GET["god"];
if (isset($god)){
  $match[] = array('match' => array('god' => $god));
};

$uniform_color = $_GET["uniform_color"];
if (isset($uniform_color)){
  $match[] = array('match' => array('uniform_color' => $uniform_color));
};

$good_play = $_GET["good_play"];
if (isset($good_play)){
  $match[] = array('match' => array('good_play' => $good_play));
};

$position = $_GET["position"];
if (isset($position)){
  $match[] = array('match' => array('position' => $position));
};

$position = $_GET["shirt_number"];
if (isset($shirt_number)){
  $match[] = array('match' => array('shirt_number' => $shirt_number));
};

$play_style = $_GET["play_style"];
if (isset($play_style)){
  $match[] = array('match' => array('play_style' => $play_style));
};

// 最後の質問の判別値
$last = $_GET["last"];

// パラメータ作成
$params = [
    'index' => 'nbator',
    'type' => 'doc',
    'body' => [
        'query' => [
            'bool' => [
                'must' => $match
            ]
        ]
    ]
];

//var_dump($params);

// 検索
$response = $client->search($params);
//var_dump($response);

// 検索結果件数によって返す値を判別する
$hits_count = $response[hits][total];

// 結果が0の場合
if($hits_count == 0) {
  print_r("false");
// 結果が1の場合
} else if($hits_count == 1) {
  $result = $response[hits][hits][0][_source][name];
  print_r($result);
// 結果が複数の場合
} else {
  // 最後の質問の場合、スコアが一番高い結果を返す
  if (isset($last)){
    $result = $response[hits][hits][0][_source][name];
    print_r($result);
  } else {
    print_r("retry");
  }
}

?>
