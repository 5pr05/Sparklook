document.addEventListener('DOMContentLoaded', event => {
	let compare = document.getElementById('username')
	compare.addEventListener('keyup', function () {
		let username = this.value

		let xhr = new XMLHttpRequest()
		xhr.open('POST', '../php/processes/check-username.php', true)
		xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
		xhr.onload = function () {
			if (this.status == 200) {
				if (xhr.responseText == '1') {
					errorMessage()
				} else {
					successMessage()
				}
			}
		}
		xhr.send('usernameComp=' + username)
	})
})

function errorMessage() {
	let message = document.getElementById('message')
	message.innerHTML = ''
	var span = document.createElement('SPAN')
	var text = document.createTextNode('USERNAME EXISTS')
	span.appendChild(text)
	message.appendChild(span)
}

function successMessage() {
	let message = document.getElementById('message')
	message.innerHTML = ''
	var span = document.createElement('SPAN')
	var text = document.createTextNode('USERNAME AVAIBLE')
	span.appendChild(text)
	message.appendChild(span)
}
