function tabHere() {
  const url = location.pathname;
  const listTab = document.querySelectorAll(".sidebar-item a");
  const checked = Array.from(listTab).some((e) => {
    return new RegExp(e.href.split("/")[7]).test(url);
  });
  if (checked) {
    for (var i = 0; i < listTab.length; i++) {
      const href = listTab[i].href;
      const temp = new RegExp(href.split("/")[7]);
      if (temp.test(url)) {
        listTab[i].classList.add("here");

        if (
          temp[1] === "quan-ly-lop" ||
          temp[1] === "quan-ly-sinh-vien-trong-lop"
        ) {
          document.querySelector(".collapsed").click();
        }

        break;
      }
    }
  } else {
    listTab[0].classList.add("here");
  }
}

tabHere();
