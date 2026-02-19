<!-- ログイン画面作成にはセッションスタートが必須！ヘッダーの前に設置する。 -->
<?php session_start(); ?>
<!-- 各ページのタイトルを記録しつつ、ヘッダーPHPを参照 -->
<?php    
$pageTitle = 'トップページ';
require 'includes/header.php';
?>
    <!-- トップページ部分 -->
    <main>
        <section class="heroBlock">
<?php
//ログインしたかを検出する文章
if (isset($_SESSION['customers'])) {
    $userName = $_SESSION['customers']['name'];
} else {
    $userName = 'ゲスト';
}
echo            '<p class="welcomeBlock">ようこそ、',$userName,'様</p>';
?>
            <div class="intro">
                <img class="hItem1" src="images/spHeroTop.png" alt="ヒーロー画像">
                <div class="newsContent">
                    <div class="hImageBlock">
                        <img class="hItem2" src="images/spNewItem.png" alt="新商品画像">
                        <img class="hItem3" src="images/spDonutLifeTop.png" alt="ドーナツのある生活">
                    </div>
                    <a href="itemList.php"><img class="hItem4" src="images/spItemListTop.png" alt="商品一覧"></a>
                </div>
                <img class="hItem5" src="images/spStoreIntroductionTop.png" alt="私たちの信念">
            </div>
        </section>
        <section class="rankBlock">
            <p class="rankHead">人気ランキング</p>
            <div class="rankGrid">
                <div class="rItem rItem1">
                    <p class="rank rank1">1</p>
                    <form action="itemDetail.php" >
                        <input type="hidden" name="id" value="1">
                        <button type="submit" >
                            <img class="itemImg tItemImg1" src="images/pcCcDonut.png" alt="1位CCドーナツ">
                        </button>
                    </form>
                    <p class="itemName">CCドーナツ 当店オリジナル（5個入り）</p>
                    <p class="price">税込  ￥1,500</p>
                    <form action="cartList.php" method="post">
                        <input type="hidden" name="id" value="1">
                        <input type="hidden" name="name" value="CCドーナツ 当店オリジナル（5個入り）">
                        <input type="hidden" name="price" value="1500">
                        <input type="hidden" name="count" value="1">
                        <input type="hidden" name="pass" value="images/pcCcDonut.png">
                        <input type="submit" value="カートに入れる" class="cartIn">
                    </form>
                </div>
                <div class="rItem rItem2">
                    <p class="rank rank2">2</p>
                    <form action="itemDetail.php" >
                        <input type="hidden" name="id" value="7">
                        <button type="submit" >
                            <img class="itemImg bItemImg1" src="images/pcFruitDonut12.png" alt="2位フルーツドーナツ12個">
                        </button>
                    </form>
                    <p class="itemName">フルーツドーナツセット（12個入り）</p>
                    <p class="price">税込  ￥3,500</p>
                    <form action="cartList.php" method="post">
                        <input type="hidden" name="id" value="7">
                        <input type="hidden" name="name" value="フルーツドーナツセット（12個入り）">
                        <input type="hidden" name="price" value="3500">
                        <input type="hidden" name="count" value="1">
                        <input type="hidden" name="pass" value="images/pcFruitDonut12.png">
                        <input type="submit" value="カートに入れる" class="cartIn">
                    </form>
                </div>
                <div class="rItem rItem3">
                    <p class="rank rank3">3</p>
                    <form action="itemDetail.php" >
                        <input type="hidden" name="id" value="8">
                        <button type="submit" >
                            <img class="itemImg bItemImg2" src="images/pcFruitDonut14.png" alt="3位フルーツドーナツ14個">
                        </button>
                    </form>
                    <p class="itemName">フルーツドーナツセット（14個入り）</p>
                    <p class="price">税込  ￥4,000</p>
                    <form action="cartList.php" method="post">
                        <input type="hidden" name="id" value="8">
                        <input type="hidden" name="name" value="フルーツドーナツセット（14個入り）">
                        <input type="hidden" name="price" value="4000">
                        <input type="hidden" name="count" value="1">
                        <input type="hidden" name="pass" value="images/pcFruitDonut14.png">
                        <input type="submit" value="カートに入れる" class="cartIn">
                    </form>
                </div>
                <div class="rItem rItem4">
                    <p class="rank rankOut">4</p>
                    <form action="itemDetail.php" >
                        <input type="hidden" name="id" value="2">
                        <button type="submit" >
                            <img class="itemImg tItemImg2" src="images/pcChocoDelight.png" alt="4位チョコデライトドーナツ">
                        </button>
                    </form>
                    <p class="itemName">チョコレートデライト（5個入り）</p>
                    <p class="price">税込  ￥1,600</p>
                    <form action="cartList.php" method="post">
                        <input type="hidden" name="id" value="2">
                        <input type="hidden" name="name" value="チョコレートデライト（5個入り）">
                        <input type="hidden" name="price" value="1600">
                        <input type="hidden" name="count" value="1">
                        <input type="hidden" name="pass" value="images/pcChocoDelight.png">
                        <input type="submit" value="カートに入れる" class="cartIn">
                    </form>
                </div>
                <div class=" rItem rItem5">
                    <p class="rank rankOut">5</p>
                    <form action="itemDetail.php" >
                        <input type="hidden" name="id" value="9">
                        <button type="submit" >
                            <img class="itemImg rItemImg5" src="images/pcBestSelection.png" alt="5位ベストセレクション">
                        </button>
                    </form>
                    <p class="itemName">ベストセレクションボックス（4個入り）</p>
                    <p class="price">税込  ￥1,200</p>
                    <form action="cartList.php" method="post">
                        <input type="hidden" name="id" value="9">
                        <input type="hidden" name="name" value="ベストセレクションボックス（4個入り）">
                        <input type="hidden" name="price" value="1200">
                        <input type="hidden" name="count" value="1">
                        <input type="hidden" name="pass" value="images/pcBestSelection.png">
                        <input type="submit" value="カートに入れる" class="cartIn">
                    </form>
                </div>
                <div class="rItem rItem6">
                    <p class="rank rankOut">6</p>
                    <form action="itemDetail.php" >
                        <input type="hidden" name="id" value="6">
                        <button type="submit">
                            <img class="itemImg bItemImg3" src="images/pcStrawberryCrash.png" alt="6位ストロベリークラッシュ">
                        </button>
                    </form>
                    <p class="itemName">ストロベリークラッシュ（5個入り）</p>
                    <p class="price">税込  ￥1,800</p>
                    <form action="cartList.php" method="post">
                        <input type="hidden" name="id" value="6">
                        <input type="hidden" name="name" value="ストロベリークラッシュ（5個入り）">
                        <input type="hidden" name="price" value="1800">
                        <input type="hidden" name="count" value="1">
                        <input type="hidden" name="pass" value="images/pcStrawberryCrash.png">
                        <input type="submit" value="カートに入れる" class="cartIn">
                    </form>
                </div>
            </div>
        </section>
    </main>
<!-- フッターPHPを参照する。 -->
<?php require 'includes/footer.php'; ?>