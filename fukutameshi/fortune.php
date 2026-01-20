

<?php 
//echo 'おみくじのサーバー側の処理ページ';
//echo  '<br>';

$omikuziList = ["大吉","中吉","中吉","超吉","超吉","吉","小吉","小吉","小吉","末吉","末吉","凶","大凶","超吉"];

$result = array_rand($omikuziList,1);
$fortune = ['運勢' => $omikuziList[$result]];


//echo '数値は',' "',$result,'" ','です。';
//echo  '<br>';
//echo '運勢は', $omikuziList[$result] ,'です。JSONファイルに保存しました。';
header('Content-Type: application/json');
file_put_contents('omikuzi.json', json_encode($fortune, JSON_UNESCAPED_UNICODE ));
echo json_encode($fortune, JSON_UNESCAPED_UNICODE );
?>