const tBody = document.querySelectorAll('tBody');
tBody.forEach(tB => {
	tB.children[0].addEventListener('click', function() {
		// const dActive = document.querySelector('.dActive');
		// toggleShow(dActive);

		toggleShow(this);
	});
});

function toggleShow(tDropdown) {
	tDropdown.classList.toggle('dActive');
	const list = tDropdown.parentElement.children;

	for(var i = 1; i < list.length; i++) {
		list[i].classList.toggle('dShow');
	}
}