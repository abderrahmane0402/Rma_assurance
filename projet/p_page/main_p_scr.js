let header = document.getElementsByTagName("header");
let elementh = document.getElementById("elementh");
let e2_w = document.getElementById("e2_w");
let e2 = document.getElementById("e2");
let e3_w = document.getElementById("e3_w");
let e3 = document.getElementById("e3");
let e4_w = document.getElementById("e4_w");
let e4 = document.getElementById("e4");
let e5_w = document.getElementById("e5_w");
let e5 = document.getElementById("e5");
let e6_w = document.getElementById("e6_w");

let x, y;
function e_size(ele, source) {
  x = ele.clientWidth;
  y = ele.clientHeight;
  source.style.width = x + "px";
  source.style.height = y + "px";
}
setInterval(e_size, 100, e6, e6_w);
setInterval(e_size, 100, e5, e5_w);
setInterval(e_size, 100, e4, e4_w);
setInterval(e_size, 100, e3, e3_w);
setInterval(e_size, 100, e2, e2_w);
setInterval(e_size, 100, header[0], elementh);

let exit_b = document.getElementById("exit");
let profile = document.getElementById("profile");
let file = document.getElementById("file");
let img = document.getElementById("img");
exit_b.addEventListener("click", () => {
  profile.style.transform = "";
});
let open_p = document.getElementById("open_p");
open_p.addEventListener("click", () => {
  profile.style.transform = "translateX(300px)";
});
file.addEventListener("change", () => {
  var imgg = URL.createObjectURL(file.files[0]);
  img.src = imgg;
});
