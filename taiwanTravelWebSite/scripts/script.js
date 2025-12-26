'use strict';


// ドロワー部分のJavaScript

const openNav = document.getElementById('openNav');
const wrapper = document.getElementById('wrapper');
const drawer = document.getElementById('drawer');
const closeNav = document.getElementById('closeNav');
//ハンバーガーの開閉トグル。
openNav.addEventListener('click', function () {
    wrapper.classList.toggle('show');
    drawer.classList.toggle('show');
    openNav.classList.toggle('vanish');
});
//クローズ押したときに、ハンバーガーにクリックを送信
closeNav.addEventListener('click', function () {
    openNav.click();
});

///ローディング画面のメソッド_提供してもらったもの
window.addEventListener("load", function () {
    const loading = document.querySelector(".loading");

    // フェードアウト
    loading.style.opacity = "0";

    // 0.5秒後に display: none にして完全に消す
    setTimeout(() => {
        loading.style.display = "none";
    }, 1500); // CSS transition と同じ時間
});



// ===== アニメーション多重防止 =====
window.spSliding = false;
window.pcSliding = false;

//構想ではカンプファイルを見て、配列作って回転させることを想定していた。
//アニメーションにてうまくいかず断念

//スマホ版の画像の並びを配列化
let baseSlider = ["images/slider4.png", "images/slider5.png", "images/slider1.png", "images/slider2.png", "images/slider3.png"];
let spCurrentIndex = 0;

//GTPに作らせたメソッドを、解読しながら冗長な部分を省いたもの

//sp版の配列の中に入っている要素の数は５個。１足して５で割った余りを算出すると配列がループする。
let spLength = baseSlider.length; //スマホ版は５になります。
//スマホ版の配列をシフトさせる関数。
function shiftArray(hairetsu, index) {
    const shift = [];
    for (let i = 0; i < spLength; i++) {
        const nextIndex = (i + index) % spLength;
        shift[i] = hairetsu[nextIndex];
    }
    return shift;
}
// スマホ版スライダーの表示更新スライダーを変えるメソッドのファンクションを設定
function updateSpSlider() {
    //今のインデックスで画像を回転配列を＋１して５で割って位置入れ替える
    const displayList = shiftArray(baseSlider, spCurrentIndex);
    //画像を反映
    const sliderImages = document.getElementsByClassName('spImage');
    for (let i = 0; i < spLength; i++) {
        sliderImages[i].src = displayList[i];//入れ替えた後の配列を新しい画像として入れ込む
    }
    //アイコンの ON/OFF を切り替えます。
    const sliderIcons = document.getElementsByClassName('spIcon');
    for (let i = 0; i < sliderImages.length; i++) {
        if (i === spCurrentIndex) {
            sliderIcons[i].src = "images/sliderIconOn.png";
        } else {
            sliderIcons[i].src = "images/sliderIconOff.png";
        }
    }
};
// スマホ版 アイコンのクリック操作
const iconButtons = document.getElementsByClassName('spIcon');
for (let i = 0; i < iconButtons.length; i++) {
    iconButtons[i].addEventListener('click', function () {
        spSlideTo(i);
    });
}
// 初期表示
updateSpSlider();


//PCばんの画像の並びを作成します。
//５から７枚にして、スマホ版と同様の事を行う。
let pcBaseSlider = ["images/slider3.png", "images/slider4.png", "images/slider5.png", "images/slider1.png", "images/slider2.png", "images/slider3.png", "images/slider4.png"];
let pcCurrentIndex = 0;   // spCurrentIndex に対応する PC版のインデックス
let pcLength = pcBaseSlider.length; //ＰＣ版は７になります。
//スマホ版の配列をシフトさせる関数。

function pcShiftArray(hairetsu, index) {
    const shift = [];
    for (let i = 0; i < pcLength; i++) {
        const nextIndex = (i + index) % pcLength;
        shift[i] = hairetsu[nextIndex];
    }
    return shift;
}
// PC版スライダーの表示更新
function pcUpdatePcSlider() {
    // ① 今のインデックスで画像を回転
    const displayList = pcShiftArray(pcBaseSlider, pcCurrentIndex);
    // ② 画像を反映
    const pcSliderImages = document.getElementsByClassName('pcImage');
    for (let i = 0; i < pcLength; i++) {
        pcSliderImages[i].src = displayList[i];
    }
    //アイコンの ON/OFF を切り替えます。
    const pcSliderIcons = document.getElementsByClassName('pcIcon');
    for (let i = 0; i < pcSliderIcons.length; i++) {
        // i=0 → 左三角, i=pcSliderIcons.length-1 → 右三角 なのでスキップ
        if (i === 0 || i === pcSliderIcons.length - 1) {
            continue;
        }
        // pcCurrentIndex が 0〜4 に対して、〇アイコンは 1〜5 番目
        if (i === pcCurrentIndex + 1) {
            pcSliderIcons[i].src = "images/sliderIconOn.png";
        } else {
            pcSliderIcons[i].src = "images/sliderIconOff.png";
        }
    }
};
const pcIconPush = document.getElementsByClassName('pcIcon');


//両端のアイコンクリック時の反応。配列を＋かー方向に１ずらすやり方で今までのやり方を踏襲しつつ、構成

// PC版アイコン（〇＋左右三角）クリック時の動作
for (let i = 0; i < pcIconPush.length; i++) {
    pcIconPush[i].addEventListener('click', function () {
        let nextIndex = pcCurrentIndex;

        if (i === 0) {
            nextIndex = (pcCurrentIndex - 1 + pcBaseSlider.length) % pcBaseSlider.length;
        } else if (i === pcIconPush.length - 1) {
            nextIndex = (pcCurrentIndex + 1) % pcBaseSlider.length;
        } else {
            nextIndex = i -1;
        }

        pcSlideTo(nextIndex);
    });
};
pcUpdatePcSlider();


//アニメーション部分は未完成。まだＧＴＰに作らせたものを解読できていないので課題とする。


// ===== SP版：アニメーション付き移動 =====
function spSlideTo(targetIndex) {
    if (window.spSliding) return;
    window.spSliding = true;

    const slider = document.querySelector('.spSlider');
    if (!slider) {
        window.spSliding = false;
        return;
    }

    // CSSアニメON
    slider.classList.add('slideMove');

    // 何枚分動くか
    const step = (targetIndex - spCurrentIndex + spLength) % spLength;
    const distance = -317 * step; // 297 + gap20

    slider.style.left = distance + 'px';

    // transitionend が来なくても必ず復帰させる
    const finish = function () {
        slider.classList.remove('slideMove');
        slider.style.left = '0px';
        spCurrentIndex = targetIndex;
        updateSpSlider();
        window.spSliding = false;
    };

    slider.addEventListener('transitionend', function handler() {
        slider.removeEventListener('transitionend', handler);
        finish();
    });

    // 保険（CSSミスでも止まらない）
    setTimeout(finish, 600);
}

// ===== SP版：自動スライド =====
setInterval(function () {
    const nextIndex = (spCurrentIndex + 1) % spLength;
    spSlideTo(nextIndex);
}, 3000);

// ===== PC版：アニメーション付き移動 =====
function pcSlideTo(targetIndex) {
    if (window.pcSliding) return;
    window.pcSliding = true;

    const slider = document.querySelector('.pcSlider');

    slider.classList.add('slideMove');

    // PCは1枚分だけ動かす設計
    const distance = -375; // PC側1フレーム幅（CSSに合わせて調整）

    slider.style.left = distance + 'px';

    slider.addEventListener('transitionend', function handler() {
        slider.removeEventListener('transitionend', handler);

        slider.classList.remove('slideMove');
        slider.style.left = '0px';

        pcCurrentIndex = targetIndex;
        pcUpdatePcSlider();

        window.pcSliding = false;
    });
};
// ===== PC版：自動スライド =====
setInterval(function () {
    const nextIndex = (pcCurrentIndex + 1) % pcLength;
    pcSlideTo(nextIndex);
}, 3000);

