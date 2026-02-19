<!-- ログイン画面作成にはセッションスタートが必須！ヘッダーの前に設置する。 -->
<?php session_start(); ?>
<!-- 各ページのタイトルを記録しつつ、ヘッダーPHPを参照 -->
<?php    
$pageTitle = '購入確認';
require 'includes/header.php';
?>
    <!-- トップページ部分 -->
    <main>
        <section class="linkBlock">
            <p class="pankuzu"><a href="index.php">TOP</a> > <a href="cartList.php">カート</a> > 購入確認</p>
            <?php
            //ログインしたかを検出する文章
            if (isset($_SESSION['customers'])) {
                $userName = $_SESSION['customers']['name'];
            } else {
                $userName = 'ゲスト';
            }
            echo            '<p class="welcomeBlock">ようこそ、',$userName,'様</p>';
            ?>
        </section>
        <section class="inputBlock ">
<?php
//ログインしていないときの判定
            if (!isset($_SESSION['customers'])) {
echo        '<p>ログインがされておりません。ログインしてください。</p>';
echo        '<a href="login.php"><p class="cBuyLetter">ログインする</p></a>';
echo        '<p>会員登録される方はこちらから</p>';
echo        '<a href="menberRegist.php"><p class="cBuyLetter">会員登録する</p></a>';
echo    '</section>';
            } else {
            if (empty($_SESSION['cartList'])) {
echo        '<p>カートが空です。商品をご確認ください。</p>';
echo        '<p class="cBuyLetter"><a href="itemList.php">商品一覧</a></p>';
echo        '<p class="cBuyLetter"><a href="index.php">TOPページへ戻る</a></p>';
echo    '</section>';
            } else {
                $totalPrice =0;
                $totalCount=0;
                foreach ($_SESSION['cartList'] as $id => $cartList) {
                    $totalPrice = $totalPrice + $cartList['price'] * $cartList['count'];
                    $totalCount = $totalCount + $cartList['count'];
                }
            }
//DBからクレジットカード情報の取得を行う
//DBの情報を秘匿するため別ファイルを経由して接続する。
require_once('connectDb.php');
$creditCheck = $pdo->prepare('SELECT * FROM creditData WHERE customer_id = ?');
$creditCheck->execute([$_SESSION['customers']['id']]);
$creditCard = $creditCheck->fetch();
echo    '<section class="inputBlock">';
echo        '<p class="titleHead">ご購入確認</p>';
echo        '<div class="purchaseBlock">';
echo            '<p class="purchaseTitle">ご購入商品</p>';
//ここで、カートの商品を一覧で出す。中心はカートの商品をforeachで繰り返させる。
//繰り返す内容にHTMLを仕込むと構造×N数個並べられる。(動的に繰り返しできるようになる。)
foreach ($_SESSION['cartList']  as $id => $cartList) {
echo            '<div class="purchaseItem">';
echo                '<div class="pRow">';
echo                '<p>商品名</p>';
echo                '<p class="pItem">',$cartList['name'],'</p>';
echo            '</div>';
echo            '<div class="pRow">';
echo                '<p>数量</p>';
echo                '<p class="pItem">',$cartList['count'],'個</p>';
echo            '</div>';
echo            '<div class="pRow">';
echo                '<p>金額</p>';
echo                '<p class="pItem">税込 ￥',$cartList['count']*$cartList['price'],'</p>';
echo            '</div>';
echo        '</div>';
        }
echo            '<p class="titleHead">合計金額 税込 ￥',$totalPrice,'</p>';
echo        '<p class="purchaseTitle">お届け先</p>';
echo        '<div class="purchasAdresss">';
echo            '<div class="pRow">';
echo                '<p>お名前</p>';
echo                '<p class="pItem">',$_SESSION['customers']['name'],'</p>';
echo            '</div>';
echo            '<div class="pRow">';
echo                '<p>郵便番号</p>';
echo                '<p class="pItem">',$_SESSION['customers']['postcode_a'],'-',$_SESSION['customers']['postcode_b'],'</p>';
echo            '</div>';
echo            '<div class="pRow">';
echo                '<p>住所</p>';
echo                '<p class="pItem">',$_SESSION['customers']['address'],'</p>';
echo            '</div>';
echo        '</div>';
echo        '<p class="purchaseTitle">お支払い方法</p>';
if ($creditCard) {
echo        '</div>';
echo        '<p class="purchaseEnter"><a href="purchaseComplete.php">購入を確定する。</a></p>';
echo        '</div>';
}   else {
echo        '<div class="purchaseCardBlock">';
echo            '<a href="creditRegist.php"><p class="purchaseEnter">カード情報登録する</p></a>';
echo            '<a href="creditRegist.php"><p class="purchaseTitle">カード情報登録がまだのお客様はこちらへお進みください。</p></a>';
echo        '</div>';
}
}//このかっこは会員登録しているとき表示する部分をくくる。場所変えない事。
echo        '<a href="itemList.php"><p class="cBuyLetter">買い物へ戻る</p></a>';
echo    '</section>';
?>
    </main>
    <!-- フッターPHPを参照する。 -->
<?php require 'includes/footer.php'; ?>