'use strict';


// メニュー開閉のスクリプト。授業でやった１個目
// document.getElementById('label1').onclick =function() {
//     document.getElementById('toggle1').classList.toggle('show')
// };
//複数あるのでまとめて設定するための設定
// まず、イベントを追加したいクラスを取得
// 開閉機能のみいったんバックアップ保存
// const cardLabels=document.querySelectorAll('.cardLabel');
// cardLabels.forEach(function(label) {
//     label.onclick= function() {
//         const opcl = label.nextElementSibling;
//         opcl.classList.toggle('show');
// // ▼マークの入れ替え
//         const triangle = label.querySelector('.triMark');
//         if (opcl.classList.contains('show')) {
//             triangle.textContent = "▲";
//         }  else {
//             triangle.textContent = "▼";
//         };
//     };
//  });
// cardLabels.forEach(function(label, index) {
//     console.log(index);
// });



//  経験値の取得
// まず、変数の取得
let getEXP =0;
let getLv = 1;
let currentLv = document.getElementById('currentLv');
let currentClass = document.getElementById('currentClass');
let currentEXP = document.getElementById('currentEXP');
let expGauge = document.getElementById('expGauge');

// 経験値が記載されたspanタグを全部クラス選択で取得して配列化
// [80,80,100,80,80,80,100]のようになる
const cardEXPList = document.querySelectorAll('.cardExp');
// 開閉のため、開閉箇所を選択
const cardLabels=document.querySelectorAll('.cardLabel');
cardLabels.forEach(function(label,index) {
    label.onclick= function() {
        const opcl = label.nextElementSibling;
        opcl.classList.toggle('show');
        // ▼マークの入れ替え
        const triangle = label.querySelector('.triMark');
        if (opcl.classList.contains('show')) {
            triangle.textContent = "▲";
        }  else {
            triangle.textContent = "▼";
        };

        if (!label.classList.contains('clear')){
        getEXP = getEXP + parseInt(cardEXPList[index].textContent)
        label.classList.add('clear');
        currentEXP.textContent=getEXP;
        expGauge.style.width = (getEXP / 640 * 100) + '%';
        };

    };
 });
cardLabels.forEach(function(label, index) {
    console.log(index);
});
