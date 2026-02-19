<!-- セッションにかかわるスクリプトはページの一番最初 -->
<!-- ログアウトもログインと同様 -->
<?php session_start(); ?>
<!-- 各ページのタイトルを記録しつつ、ヘッダーPHPを参照 -->
<?php    
$pageTitle = 'ログアウト完了';
require 'includes/header.php';
?>
    <!-- トップページ部分 -->
    <main>
        <?php
        if(isset($_SESSION['customers'])) {
            unset($_SESSION['customers']);
            echo    '<p class="titleHead">ログアウト完了</p>';
            echo    '<div class="loginBlock compBlock">';
            echo        '<p class="loginText compTxt">ログアウトしました。</p>';
            echo        '<p class="loginText compTxt">またのお越しをお待ちしております。</p>';
            echo    '</div>';
        }   else {
            echo    '<div class="loginBlock compBlock">';
            echo        '<p class="loginText compTxt">すでにログアウトしています。</p>';
            echo    '</div>';
        }
        ?>
    </main>
    <!-- フッターPHPを参照する。 -->
<?php require 'includes/footer.php'; ?>