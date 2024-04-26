tabHere();
function tabHere() {
	const url = location.pathname;
	const regex = /\/([^/\.]+)\.php/;
	const match = url.match(regex);
	console.log(match[1]);

	const listTab = document.querySelectorAll('.sidebar a');
	for (var i = 0; i < listTab.length; i++) {
		const href = listTab[i].href;
		const temp = href.match(regex);
		if(temp[1] === match[1]) {
			listTab[i].classList.add('here');
			break;
		}
		console.log(1);
	}
}