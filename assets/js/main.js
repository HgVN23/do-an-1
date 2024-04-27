async function tabHere() {
  const url = location.pathname;
  const regex = /\/([^/\.]+)\.php/;
  const match = url.match(regex);
  //   console.log(match[1]);
  const listTab = document.querySelectorAll(".sidebar-item a");
  for (var i = 0; i < listTab.length; i++) {
    const href = listTab[i].href;
    const temp = href.match(regex);
    console.log("href", href);
    console.log("match", match[1]);
    if (temp[1] === match[1]) {
      await listTab[i].classList.add("here");
      console.log(document.querySelectorAll(".sidebar-item a")[i]);
      break;
    }
    console.log(1);
  }
}

tabHere();
