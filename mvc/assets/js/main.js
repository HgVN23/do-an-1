function tabHere() {
  const url = location.pathname;
  const listTab = document.querySelectorAll(".sidebar-item a");

  const checked = Array.from(listTab).some((e) => {
    const t = e.getAttribute("href");
    return new RegExp(t).test(url);
  });
  if (checked) {
    for (var i = 0; i < listTab.length; i++) {
      const href = listTab[i].getAttribute("href");
      const temp = new RegExp(href);
      if (temp.test(url)) {
        listTab[i].classList.add("here");

        if (temp.test("quan-ly-lop") || temp.test("sinh-vien-trong-lop")) {
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
