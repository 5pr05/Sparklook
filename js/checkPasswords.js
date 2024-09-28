document.addEventListener('DOMContentLoaded', event => {
	document.getElementById('password').addEventListener('keyup', checkPasswords)
	document
		.getElementById('conf-password')
		.addEventListener('keyup', checkPasswords)
})

function checkPasswords() {
	var password = document.getElementById('password').value
	var confirmPassword = document.getElementById('conf-password').value
	let message = document.getElementById('message')

	if (password != confirmPassword) {
		message.innerHTML = ''
		var span = document.createElement('SPAN')
		var text = document.createTextNode('PASSWORDS DO NOT MATCH')
		span.appendChild(text)
		message.appendChild(span)
	} else {
		message.innerHTML = ''
	}
}
