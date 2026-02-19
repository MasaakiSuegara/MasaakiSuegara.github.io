<!-- ログイン画面作成にはセッションスタートが必須！ヘッダーの前に設置する。 -->
<?php session_start(); ?>
<!-- 各ページのタイトルを記録しつつ、ヘッダーPHPを参照 -->
<?php    
$pageTitle = '商品一覧';
require 'includes/header.php';
?>
    <!-- トップページ部分 -->
    <main>
        <section class="linkBlock">
            <?php
            //ログインしたかを検出する文章
            if (isset($_SESSION['customers'])) {
                $userName = $_SESSION['customers']['name'];
            } else {
                $userName = 'ゲスト';
            }
echo        '<p class="welcomeBlock">ようこそ、',$userName,'様</p>';
            ?>
            <p class="pankuzu"><a href="index.php">TOP</a> > <a href="itemList.php">商品一覧</a></p>
        </section>
        <section class="rankBlock">
            <p class="rankHead">商品一覧</p>
            <p class="title">メインメニュー</p>
            <!-- カートとセッションを実装する。まずはHTMLにカートに送る情報を直打ちする。0129 -->
            <!-- いずれはデータベース参照の引き抜きと繰り返しによる圧縮はあるだろうが、まずは機能をさきに作る。 -->
            <div class="rankGrid">
                <div class="tbItem rItem1">
<!-- 画像クリックにより商品詳細に飛び、かつ商品詳細の中身を変えるために画像にフォームタグつけてidの情報を飛ばす -->
                    <form action="itemDetail.php" class="">
                        <input type="hidden" name="id" value="1">
                        <button type="submit" class="">
                            <img class="itemImg tItemImg1" src="images/pcCcDonut.png" alt="画像1">
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
               <div class="tbItem rItem2">
                    <form action="itemDetail.php" class="">
                        <input type="hidden" name="id" value="2">
                        <button type="submit" class="">
                            <img class="itemImg tItemImg2" src="images/pcChocoDelight.png" alt="画像2">
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
                <div class="tbItem rItem3">
                    <form action="itemDetail.php" class="">
                        <input type="hidden" name="id" value="3">
                        <button type="submit" class="">
                            <img class="itemImg tItemImg3" src="images/pcCaramelDonut.png" alt="画像3">
                        </button>
                    </form>
                    <p class="itemName">キャラメルクリーム（5個入り）</p>
                    <p class="price">税込  ￥1,600</p>
                    <form action="cartList.php" method="post">
                        <input type="hidden" name="id" value="3">
                        <input type="hidden" name="name" value="キャラメルクリーム（5個入り）">
                        <input type="hidden" name="price" value="1600">
                        <input type="hidden" name="count" value="1">
                        <input type="hidden" name="pass" value="images/pcCaramelDonut.png">
                        <input type="submit" value="カートに入れる" class="cartIn">
                    </form>
                </div>
                <div class="tbItem ritem4">
                    <form action="itemDetail.php" class="">
                        <input type="hidden" name="id" value="4">
                        <button type="submit" class="">
                            <img class="itemImg tItemImg4" src="images/pcPlaneClasic.png" alt="画像4">
                        </button>
                    </form>
                    <p class="itemName">プレーンクラシック（5個入り）</p>
                    <p class="price">税込  ￥1,500</p>
                    <form action="cartList.php" method="post">
                        <input type="hidden" name="id" value="4">
                        <input type="hidden" name="name" value="プレーンクラシック（5個入り）">
                        <input type="hidden" name="price" value="1500">
                        <input type="hidden" name="count" value="1">
                        <input type="hidden" name="pass" value="images/pcPlaneClasic.png">
                        <input type="submit" value="カートに入れる" class="cartIn">
                    </form>
                </div>
                <div class="tbItem  rItem5">
                    <form action="itemDetail.php" class="">
                        <input type="hidden" name="id" value="5">
                        <button type="submit" class="">
                            <img class="itemImg tItemImg5" src="images/pcSummerCitrusDonut.png" alt="画像5">
                        </button>
                    </form>
                    <p class="itemName">【新作】サマーシトラス（5個入り）</p>
                    <p class="price">税込  ￥1,600</p>
                    <form action="cartList.php" method="post">
                        <input type="hidden" name="id" value="5">
                        <input type="hidden" name="name" value="サマーシトラス（5個入り）">
                        <input type="hidden" name="price" value="1600">
                        <input type="hidden" name="count" value="1">
                        <input type="hidden" name="pass" value="images/pcSummerCitrusDonut.png">
                        <input type="submit" value="カートに入れる" class="cartIn">
                    </form>
                </div>
                <div class="tbItem rItem6">
                    <form action="itemDetail.php" class="">
                        <input type="hidden" name="id" value="6">
                        <button type="submit" class="">
                            <img class="itemImg tItemImg6" src="images/pcStrawberryCrash.png" alt="画像6">
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
        <section class="rankBlock">
            <p class="title">バラエティセット</p>
            <div class="rankGrid">
                <div class="tbItem rItem1">
                    <form action="itemDetail.php" class="">
                        <input type="hidden" name="id" value="7">
                        <button type="submit" class="">
                            <img class="itemImg bItemImg1" src="images/pcFruitDonut12.png" alt="画像">
                        </button>
                    </form>
                    <p class="itemName">フルーツドーナツセット<br>（12個入り）</p>
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
                <div class="tbItem  rItem2">
                    <form action="itemDetail.php" class="">
                        <input type="hidden" name="id" value="8">
                        <button type="submit" class="">
                            <img class="itemImg bItemImg2" src="images/pcFruitDonut14.png" alt="画像">
                        </button>
                    </form>
                    <p class="itemName">フルーツドーナツセット<br>（14個入り）</p>
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
                <div class="tbItem  rItem3">
                    <form action="itemDetail.php" class="">
                        <input type="hidden" name="id" value="9">
                        <button type="submit" class="">
                            <img class="itemImg bItemImg3" src="images/pcBestSelection.png" alt="画像">
                        </button>
                    </form>
                    <p class="itemName">ベストセレクションボックス<br>（4個入り）</p>
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
                <div class="tbItem ritem4">
                    <form action="itemDetail.php" class="">
                        <input type="hidden" name="id" value="10">
                        <button type="submit" class="">
                            <img class="itemImg bItemImg4" src="images/pcChocoCrashDonut.png" alt="画像">
                        </button>
                    </form>
                    <p class="itemName">チョコクラッシュボックス（7個入り）</p>
                    <p class="price">税込  ￥2,400</p>
                    <form action="cartList.php" method="post">
                        <input type="hidden" name="id" value="10">
                        <input type="hidden" name="name" value="チョコクラッシュボックス（7個入り）">
                        <input type="hidden" name="price" value="2400">
                        <input type="hidden" name="count" value="1">
                        <input type="hidden" name="pass" value="images/pcChocoCrashDonut.png">
                        <input type="submit" value="カートに入れる" class="cartIn">
                    </form>
                </div>
                <div class="tbItem rItem5">
                    <form action="itemDetail.php" class="">
                        <input type="hidden" name="id" value="11">
                        <button type="submit" class="">
                            <img class="itemImg bItemImg5" src="images/pcCreamBoxDonut4.png" alt="画像">
                        </button>
                    </form>
                    <p class="itemName">クリームボックス<br>（9個入り）</p>
                    <p class="price">税込  ￥1,400</p>
                    <form action="cartList.php" method="post">
                        <input type="hidden" name="id" value="11">
                        <input type="hidden" name="name" value="クリームボックス（4個入り）">
                        <input type="hidden" name="price" value="1400">
                        <input type="hidden" name="count" value="1">
                        <input type="hidden" name="pass" value="images/pcCreamBoxDonut4.png">
                        <input type="submit" value="カートに入れる" class="cartIn">
                    </form>
                </div>
                <div class="tbItem rItem6">
                    <form action="itemDetail.php" class="">
                        <input type="hidden" name="id" value="12">
                        <button type="submit" class="">
                            <img class="itemImg bItemIm6" src="images/pcCreamBoxDonut9.png" alt="画像">
                        </button>
                    </form>
                    <p class="itemName">クリームボックス<br>（9個入り）</p>
                    <p class="price">税込  ￥2,800</p>
                    <form action="cartList.php" method="post">
                        <input type="hidden" name="id" value="12">
                        <input type="hidden" name="name" value="クリームボックス（9個入り）">
                        <input type="hidden" name="price" value="2800">
                        <input type="hidden" name="count" value="1">
                        <input type="hidden" name="pass" value="images/pcCreamBoxDonut9.png">
                        <input type="submit" value="カートに入れる" class="cartIn">
                    </form>
                </div>
            </div>
        </section>
    </main>
<!-- フッターPHPを参照する。 -->
<?php require 'includes/footer.php'; ?>