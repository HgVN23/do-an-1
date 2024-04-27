function tabHere() {
	const url = location.pathname;
	const regex = /\/([^/\.]+)\.php/;
	const match = url.match(regex);
	// console.log(match[1]);

	const listTab = document.querySelectorAll(".sidebar-item a");
	for(var i = 0; i < listTab.length; i++) {
		const href = listTab[i].href;
		const temp = href.match(regex);

		if(temp[1] === match[1]) {
			listTab[i].classList.add("here");

			if(temp[1] === "quan-ly-lop" || temp[1] === "quan-ly-sinh-vien-trong-lop") {
				document.querySelector(".collapsed").click();
			}

			break;
		}
		// console.log(1);
	}
}

tabHere();
