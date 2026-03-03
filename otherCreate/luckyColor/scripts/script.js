'use strict';

///1225最初のファンクション

document.getElementById('cButton').onclick = function () {
    console.log('カラーナンバー')

    const redNum = Math.floor(Math.random() * 256);
    console.log(redNum);
    document.getElementById('redBox').textContent = redNum;

    const greenNum = Math.floor(Math.random() * 256);
    console.log(greenNum);
    document.getElementById('greenBox').textContent = greenNum;

    const blueNum = Math.floor(Math.random() * 256);
    console.log(blueNum);
    document.getElementById('blueBox').textContent = blueNum;
};


///失敗した残骸


function colorChange(colorBox) {
    const colorNum = Math.floor(Math.random() * 256);
    console.log(colorNum);
    colorBox.textContent = colorNum;
}
document.getElementById('cButton').onclick = function () {

    console.log('カラーナンバー')
    colorChange(document.getElementById('redBox'));
    colorChange(document.getElementById('greenBox'));
    colorChange(document.getElementById('blueBox'));
    document.getElementById('colorBox').style.backgroundColor = `rgba(${redBox}, ${greenBox}, ${blueBox}, 1)`;
};

