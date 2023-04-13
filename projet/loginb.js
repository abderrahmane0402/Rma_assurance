// let body = document.getElementsByClassName("p_page");
// let font = document.getElementById("main");
// let logoo = document.getElementById("logo");
var x = window.innerHeight;
var y = window.innerWidth;
// function sizescreen() {
//   body[0].style.height = `${x}` + "px";
//   body[0].style.width = `${y}` + "px";
//   x = window.innerHeight;
//   y = window.innerWidth;
//   setTimeout(sizescreen, 100);
// }
// var fs = (window.innerWidth * 80) / 604;
// function rfs() {
//   if (fs < 130) {
//     font.style.fontSize = `${fs}` + "px";
//   } else {
//     font.style.fontSize = 130 + "px";
//   }
//   fs = (window.innerWidth * 80) / 604;
//   setTimeout(rfs, 100);
// }
// var mtl = (window.innerWidth * 220) / 787;
// function up() {
//   if (mtl < 248) {
//     font.style.marginBottom = mtl + "px";
//   } else {
//     font.style.marginBottom = 248 + "px";
//   }
//   mtl = (window.innerWidth * 200) / 787;
//   setTimeout(up, 100);
// }
// function logo() {
//   logoo.style.opacity = "1";
// }
// var lgw = (window.innerWidth * 350) / 604;
// var lgh = (window.innerHeight * 100) / 789;
// function logow() {
//   logoo.style.height = lgh + "px";
//   logoo.style.width = lgw + "px";
//   lgw = (window.innerWidth * 330) / 604;
//   lgh = (window.innerHeight * 130) / 789;
//   setTimeout(logow, 100);
// }
// sizescreen();
// setTimeout(rfs, 1);
// logow();
// setTimeout(up, 3000);
// setTimeout(logo, 3500);

// // close
// function close_b() {
//   body[0].style.borderRadius = "100%";
// }
// function close_bd() {
//   body[0].style.transform = "scale(0,0)";
// }
// function close() {
//   body[0].style.display = "none";
// }
// setTimeout(close_b, 7000);
// setTimeout(close_bd, 8000);
// setTimeout(close, 11000);

// login p
let s = document.getElementById("d1");
function sizescreen2() {
  s.style.height = `${x}` + "px";
  s.style.width = `${y}` + "px";
  x = window.innerHeight;
  y = window.innerWidth;
  setTimeout(sizescreen2, 100);
}
sizescreen2();
