document.querySelector('.edit-idea').addEventListener('submit', function (e) {
	e.preventDefault()
	document.querySelector('#title').readOnly = false
	document.querySelector('#description').readOnly = false
	document.querySelector('#confirmButton').style.display = 'block'
})
