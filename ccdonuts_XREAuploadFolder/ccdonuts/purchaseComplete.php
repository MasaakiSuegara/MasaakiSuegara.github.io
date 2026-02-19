<!-- ログイン画面作成にはセッションスタートが必須！ヘッダーの前に設置する。 -->
<?php session_start(); ?>
<!-- 各ページのタイトルを記録しつつ、ヘッダーPHPを参照 -->
<?php    
$pageTitle = '購入完了';
require 'includes/header.php';
?>
    <!-- トップページ部分 -->
    <main>
        <section class="linkBlock">
            <p class="pankuzu"><a href="index.php">TOP</a> > <a href="cartList.php">カート</a> > 購入確認 > 購入完了</p>
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
        <section class="inputBlock">
            <p class="titleHead">ご購入完了</p>
            <div class="loginBlock compBlock">
                <p class="loginText compTxt">ご購入いただきありがとうございます。</p>
                <p class="loginText compTxt">今後ともご愛顧の程、宜しくお願いいたします。</p>
            </div>
            <p class="pageLink"><a href="index.php">TOPページへもどる</a></p>
        </section>
    </main>
    <!-- フッターPHPを参照する。 -->
<?php require 'includes/footer.php'; ?>