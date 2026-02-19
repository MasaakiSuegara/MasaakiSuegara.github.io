<!-- ログイン画面作成にはセッションスタートが必須！ヘッダーの前に設置する。 -->
<?php session_start(); ?>
<!-- 各ページのタイトルを記録しつつ、ヘッダーPHPを参照 -->
<?php    
$pageTitle = 'カート一覧';
require 'includes/header.php';
?>
    <!-- トップページ部分 -->
<main>
    <section class="linkBlock">
        <p class="pankuzu"><a href="index.php">TOP</a> > <a href="cartList.php">カート</a></p>
<?php
//文頭の！に注目。！が入ってるってことは否定→cartInがないときという意味
//cartIN(カートに使う変数)が無いとき、中身からのカートを作るという意味
//セッションはユーザーに与える情報のやり取り。その中にcartListの配列を入れるという意味
if(!isset($_SESSION['cartList'])) {
    $_SESSION['cartList']=[];
}
//次に空白のカートリストに中身を入れていく。
//前のページから送られてきたidつまりカートに入れる指示があるとき以下を動かす。
if(isset($_REQUEST['id'])) {
    $id=$_REQUEST['id'];

    if(isset($_REQUEST['recalc'])) {
        if(isset($_SESSION['cartList'][$id])) {
            $_SESSION['cartList'][$id]['count'] = (int)$_REQUEST['count'];
        }
    } else {
//すでにカートにある商品の場合は個数の更新だけ行う
//次はすでに配列に入っている商品がリクエストされたとき、配列に追加ではなくカウントを増加させるようにする仕組みを作る。
//教科書P294を写経しつつ作成した。
    if (isset($_SESSION['cartList'][$id])) {
//まず変数countをそのidのcountの数にして、追加する。
        $count=$_SESSION['cartList'][$id]['count'];
        $_SESSION['cartList'][$id]=[
            'name'  => $_REQUEST['name'],
            'price' => $_REQUEST['price'],
            'count' => $count+$_REQUEST['count'],
            'pass'  => $_REQUEST['pass']
        ];
    }   else {
//なにもなければ新規追加する。
        $_SESSION['cartList'][$id]=[
            'name'  => $_REQUEST['name'],
            'price' => $_REQUEST['price'],
            'count' => $_REQUEST['count'],
            'pass'  => $_REQUEST['pass']
        ];
    }
}
}
//全商品の合計金額を算出する。foreach ($_SESSION['cartList'] as $id=>$cartList)をもとにして
$totalPrice =0;
$totalCount=0;
if(!empty($_SESSION['cartList'])) {
    foreach ($_SESSION['cartList'] as $id=>$cartList){
        $totalPrice = $totalPrice + $cartList['price']*$cartList['count'];
        $totalCount= $totalCount + $cartList['count'];
    }
};
//ログインしたかを検出する文章
if (isset($_SESSION['customers'])) {
    $userName = $_SESSION['customers']['name'];
} else {
    $userName = 'ゲスト';
}
//これは応用の短縮編。勉強して使えるようにする。
// $userName = isset($_SESSION['customers'])? $_SESSION['customers']['name'] : 'ゲスト';
echo        '<p class="pankuzu">ようこそ、',$userName,'様</p>';
echo    '</section>';
echo    '<section class="cartBlock">';
echo        '<div class="cartSubtotal">';
echo            '<p class="cLetter cCenter">現在  商品<span>',$totalCount, '点</span></p>';
//小計を出す式を作ること
echo            '<p class="cLetter cCenter">ご注文小計:税込<span class="priceSubtotal">￥',$totalPrice,'</span></p>';
echo            '<p class="cBuyLetter"><a href="purchase.php">購入確認へ進む</a></p>';
echo        '</div>';
//教科書P299を写経しつつ作成
//!empty関数は、対象の値が空の時true。そもそも定義(存在)しているのでissetだと必ずtrueになるため
// !emptyで空でない→カートになにか入っているときという意味教科書はP236を参照。
if(!empty($_SESSION['cartList'])) {
    foreach ($_SESSION['cartList'] as $id=>$cartList){
// 以下は他ページと同じ変数と文字列連結の組み合わせ。
echo        '<div class="cItem1">';
echo            '<img class="cItemImg" src="',$cartList['pass'],'" alt="商品">';
echo            '<div class="pcCart">';
echo                '<p class="cItemName cCenter">',$cartList['name'],'</p>';
echo                '<p class="price cPrice cCenter">税込  ￥',$cartList['price']*$cartList['count'],'</p>';
echo                '<form action="cartList.php">';
echo                    '<div class="cBuyItem cCenter">';
echo                        '<p class="cItemNumber ">数量</p>';
echo                        '<input type="number" class="buyNumber" name="count" value="',$cartList['count'],'">';
echo                        '<p class="cko">個</p>';
echo                    '</div>';
//再計算ブロック。再計算を押したとき、個数と再計算という情報あとif分岐のためのinputのrecalcをおなじページにとばす
//recalcのとき、再計算の処理をするようif文の最初のほうに持ってくる。
echo                    '<input type="hidden" name="id" value="',$id,'">';
echo                    '<input type="hidden" name="recalc" value="recalc">';
echo                    '<input type="submit" class="cCartIn cCenter" value="再計算">';
echo                '</form>';
//教科書P301pを確認すること、aに情報載せ方書いてある、リンク先にid飛ばして削除する。
//教科書のやり方。通常のリンク＋GET方式(url)に情報を仕込んで送信
echo                '<form action="cartDelete.php">';
echo                    '<input type="hidden" name="id" value="',$id,'">';
echo                    '<input type="submit" class="cCartOut cCenter" value="削除">';
echo                '</form>';
echo            '</div>';
echo        '</div>';
        }
} else {
echo       '<p class="cItemName cCenter">カートに商品が入っておりません。</p>';
};
echo        '<div class="cartSubtotal">';
echo            '<p class="cLetter cCenter">現在  商品<span>',$totalCount, '点</span></p>';
echo            '<p class="cLetter cCenter">ご注文小計:税込<span class="priceSubtotal">￥"',$totalPrice,'"</span></p>';
echo            '<p class="cBuyLetter"><a href="purchase.php">購入確認へ進む</a></p>';
echo        '</div>';
echo        '<p class="continueBuy"><a href="itemList.php">買い物を続ける</a></p>';
echo    '</section>';
//デバッグ用の配列を表示させるコマンド。
// echo '<pre>';
// var_dump($_SESSION['cartList']);
// echo '</pre>';
?>
</main>
<!-- フッターPHPを参照する。 -->
<?php require 'includes/footer.php'; ?>