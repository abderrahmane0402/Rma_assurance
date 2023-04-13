let row = document.querySelectorAll(".row");
row.forEach((r) => {
  r.querySelector(".fa-circle-check").addEventListener("click", () => {
    r.querySelectorAll("td").forEach((td) => {
      td.style.textdecoration = "line-through";
    });
    r.querySelector(".fa-circle-check").classList.replace(
      "fa-circle-check",
      "fa-circle-xmark"
    );
  });
});
