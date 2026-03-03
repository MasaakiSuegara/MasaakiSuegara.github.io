
'use strict';
  window.addEventListener("load", function() {
  const loading = document.querySelector(".loading");
  
  // フェードアウト
  loading.style.opacity = "0";
  
  // 0.5秒後に display: none にして完全に消す
  setTimeout(() => {
    loading.style.display = "none";
  }, 500); // CSS transition と同じ時間
});

function setNavText() {
  const navUl = document.querySelector(".navigation ul");
  //「class navigationのul」を探してきて「navUl」を代入するよ宣言！

  if (window.innerWidth < 768) { //もし画面の幅が768ピクセル以上なら…
    navUl.innerHTML = `
      <li><a href="#">top</a></li>
      <li><a href="#">Travel</a></li>
      <li><a href="#">台南</a></li>
    `;                          //navUlの中のHTMLを↑に書き換えて
  } else {                      //falseなら
    navUl.innerHTML = `
      <li><a href="#">home</a></li>
      <li><a href="#">Travel</a></li>
      <li><a href="#">台南</a></li>
    `;
  }                             //navUlのinnerHTMLを↑に書き換える
}

setNavText();                 // ページ読み込み時に
window.addEventListener("resize", setNavText); // ←画面サイズ変更時にも実行される！


// ------------------------------------------
// 1. 開くボタンと閉じるボタンを全て取得
// ------------------------------------------

// 夜市ボタン（開くトリガー）
const openBtns = document.querySelectorAll('.item[data-modal]'); 

// モーダル内の閉じるボタン（✕マーク）
const closeBtns = document.querySelectorAll('.close-btn');
const overlay = document.getElementById('modal-overlay');

// ------------------------------------------
// 2. モーダルを開く処理
// ------------------------------------------

openBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        // クリックされたボタンの data-modal="N" の値（N）を取得
        const modalId = btn.getAttribute('data-modal');
        // 対応するモーダル要素（例: id="modal-2"）を取得
        const targetModal = document.getElementById(`modal-${modalId}`);
        
        if (targetModal) {
            targetModal.classList.add('active');
            overlay.classList.add('active');  // ← 追加
        }
    });
});

// ------------------------------------------
// 3. モーダルを閉じる処理（✕ボタンと背景クリックに対応）
// ------------------------------------------

// ✕ボタンによる閉じる処理
closeBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        // 閉じるボタンの親要素の親要素（.modal）を取得
        const modal = btn.closest('.modal');
        if (modal) {
            modal.classList.remove('active');
            overlay.classList.remove('active'); // ← 追加
        }
    });
});

// モーダルの背景クリックによる閉じる処理 
document.querySelectorAll('.modal').forEach(modal => {
    modal.addEventListener('click', (e) => {
        // クリックした要素が .modal 要素自体である場合（背景クリック）
        if (e.target.classList.contains('modal')) {
            modal.classList.remove('active');
            overlay.classList.remove('active'); // ←追加
        }
    });
});

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