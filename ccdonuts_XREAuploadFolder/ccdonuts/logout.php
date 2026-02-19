<!-- ログイン画面作成にはセッションスタートが必須！ヘッダーの前に設置する。 -->
<?php session_start(); ?>
<!-- 各ページのタイトルを記録しつつ、ヘッダーPHPを参照 -->
<?php    
$pageTitle = 'ログアウト確認';
require 'includes/header.php';
?>
    <!-- トップページ部分 -->
    <main>
        <section class="linkBlock">
            <p class="pankuzu"><a href="index.php">TOP</a> > ログアウト</p>
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
            <!-- formは必要ないが、デザインとCSS流用のためいったんこのまま使用する -->
            <p class="titleHead">ログアウト</p>
            <form action="logoutComplete.php" class="loginBlock">
                <input type="submit" value="ログアウトする。" class="loginEnter">
                <p class="logoutText"><a href="itemList.php">買い物を続ける場合はこちら</a></p>
                <p class="logoutText"><a href="index.php">TOPページへもどる</a></p>
            </form>
        </section>
    </main>
    <!-- フッターPHPを参照する。 -->
<?php require 'includes/footer.php'; ?>