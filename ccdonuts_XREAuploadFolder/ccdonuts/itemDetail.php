<!-- ログイン画面作成にはセッションスタートが必須！ヘッダーの前に設置する。 -->
<?php session_start(); ?>
<!-- 各ページのタイトルを記録しつつ、ヘッダーPHPを参照 -->
<?php    
$pageTitle = '商品詳細';
require 'includes/header.php';
?>
<?php
//受け取った値を整数にして読み込ませる。
$intId=(int)$_REQUEST['id'];
$image=$products[$intId];
// PDOメソッド
//データベースの名前を指定して、IDPWを持ってアクセスする。
//DBの情報を秘匿するため別ファイルを経由して接続する。
require_once('connectDb.php');
// アクセスしたＤＢにはcustomersとproductsという2つのテーブルがある。
//今回は商品情報が欲しいのでproductsを指定する。
// 今回は全部持ってきて必要なものを適用する。fetchとやらで指定できるらしいが一回おいておく。
//今回idを元に引っ張りたい。なのでidは可変だぞとwhere id=?で宣言
$itemDetailList = $pdo->prepare('select * from products where id=?');
//executeメソッドで?にしたところにこっちが指定した値をいれる。入れるのはid番号
$itemDetailList->execute([$intId]);
foreach ($itemDetailList as $detail) {
//トップページ部分
echo    '<main>';
echo        '<section class="linkBlock">';
echo            '<p class="pankuzu"><a href="index.php">TOP</a> > <a href="itemList.php">商品一覧</a> > ',$detail['name'],' </p>';
//ログインしたかを検出する文章
                if (isset($_SESSION['customers'])) {
                    $userName = $_SESSION['customers']['name'];
                } else {
                    $userName = 'ゲスト';
                }
echo            '<p class="welcomeBlock">ようこそ、',$userName,'様</p>';
echo        '</section>';
echo        '<section class="itemDetail">';
echo            '<div class="dItem">';
echo                '<img class="dItemImg" src="',$image,'" alt="1個目CCドーナツ">';
echo                '<form action="cartList.php" method="post">';
echo                    '<p class="dItemName">',$detail['name'],'</p>';
echo                    '<div class="dBorder"></div>';
echo                    '<p class="dIntroduction">',$detail['introduction'],'</p>';
echo                    '<div class="dBorder"></div>';
echo                    '<p class="price dPrice">税込  ￥',$detail['price'],'</p>';
echo                    '<div class="dBuyItem">';
echo                        '<input type="text" class="buyNumber" name="count" value="1">';
echo                        '<p class="dko">個</p>';
echo                        '<input type="hidden" name="id" value="',$detail['id'],'">';
echo                        '<input type="hidden" name="name" value="',$detail['name'],'">';
echo                        '<input type="hidden" name="price" value="',$detail['price'],'">';
echo                        '<input type="hidden" name="pass" value="',$image,'">';
echo                        '<input type="submit" value="カートに入れる" class="cartIn">';
echo                        '<img class="heartMark" src="images/pcHeartIcon.svg" alt="ハートマーク">';
echo                     '</div>';
echo                '</form>';
echo            '</div>';
echo        '</section>';
echo    '</main>';
}
?>
    <!-- フッターPHPを参照する。 -->
<?php require 'includes/footer.php'; ?>