<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="common/reset.css">
    <link rel="stylesheet" href="styles/style.css">
    <!-- 以下３行分がgooglefontのリンク -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&display=swap" rel="stylesheet">
    <title>
    <?php
    if(isset($pageTitle)) {
        echo $pageTitle;
    }   else {echo  'CCドーナツ'; }
    ?>
    </title>
</head>
<body>
    <!-- エラーメッセージの表示設定。編集中は"E_ALL"(すべて表示する。)、本番環境では"0"(表示しない。)にすること -->
     <?php error_reporting(0); ?>
    <!-- ヘッダーは作成後分解-->
    <header class="headerBlock">
        <div class="headerRow">
            <nav class="gMenu">
                <input class="menu-btn" type="checkbox" id="menu-btn">
                <label class="menu-icon" for="menu-btn">
                    <span class="navicon"></span>
                </label>
                <ul class="menu">
                    <li><a href="index.php">TOP</a></li>
                    <li><a href="itemList.php">商品一覧</a></li>
                    <li><a href="#">よくある質問</a></li>
                    <li><a href="#">お問い合わせ</a></li>
                    <li><a href="#">当サイトのポリシー</a></li>
                </ul>
            </nav>
            <a href="index.php"><img class="hLogo" src="images/spLogo.svg" alt="ロゴ"></a>
<?php
//ログインとログアウト時でログインログアウトアイコンを切り替える。
            if (isset($_SESSION['customers'])) {
                $logInOut = "images/logout.svg";
                $logLink ="logout.php";
            }   else {
                $logInOut = "images/spLogin.svg";
                $logLink ="login.php";
            }
echo        '<a href=',$logLink,'><img class="hLogin" src=',$logInOut,' alt="ログインアイコン"></a>';
?>
            <a href="cartList.php"><img class="hCart" src="images/spCart.svg" alt="カートアイコン"></a>
        </div>
        <form action="#" class="searchBlock">
            <button type="submit" class="searchBtn">
                <img src="images/spSeachIcon.svg" alt="検索">
            </button>
            <input class="searchBox" type="text" name="search" placeholder="キーワードを入力" value="">
        </form>
    </header>    
    <?php 
    //商品画像の参照先一覧表(DBに作成指示がないため個別に作成)
    $products = [
        1 => 'images/pcCcDonut.png',
        2 => 'images/pcChocoDelight.png',
        3 => 'images/pcCaramelDonut.png',
        4 => 'images/pcPlaneClasic.png',
        5 => 'images/pcSummerCitrusDonut.png',
        6 => 'images/pcStrawberryCrash.png',
        7 => 'images/pcFruitDonut12.png',
        8 => 'images/pcFruitDonut14.png',
        9 => 'images/pcBestSelection.png',
        10 => 'images/pcChocoCrashDonut.png',
        11 => 'images/pcCreamBoxDonut4.png',
        12 => 'images/pcCreamBoxDonut9.png',
    ]
    ?>

