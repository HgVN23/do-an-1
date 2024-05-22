const tBody = document.querySelectorAll("tBody");

tBody.forEach((tB) => {
  tB.children[0] &&
    tB.children[0].addEventListener("click", function () {
      toggleShow(this);
    });
});

function toggleShow(tDropdown) {
  tDropdown.classList.toggle("dActive");
  const list = tDropdown.parentElement.children;
  for (var i = 1; i < list.length; i++) {
    list[i].classList.toggle("dShow");
  }
}

tBody.forEach((tB) => {
  tB.children[0] && tB.children[0].click();
});
