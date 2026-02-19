<!-- ログイン画面作成にはセッションスタートが必須！ヘッダーの前に設置する。 -->
<?php session_start(); ?>
<!-- 各ページのタイトルを記録しつつ、ヘッダーPHPを参照 -->
<?php    
$pageTitle = 'カート削除';
require 'includes/header.php';
?>
    <!-- トップページ部分 -->
    <main>
        <section class="linkBlock">
            <p class="pankuzu"><a href="index.php">TOP</a> > <a href="cartList.php">カート</a> > 削除完了</p>
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
        <section class="cartBlock">
            <?php
                if (isset($_REQUEST['id'])){
                    unset($_SESSION['cartList'][$_REQUEST['id']]);
            echo        '<p class="cItemName cCenter">カートから商品を削除しました。</p>';
                } else {
            echo        '<p class="cItemName cCenter">商品はカートにありませんでした。</p>';
                };
            echo        '<a href="cartList.php"><p class="cBuyLetter ">カートへ戻る。</p></a>';
            ?>    
        </section>
</main>
<!-- フッターPHPを参照する。 -->
<?php require 'includes/footer.php'; ?>