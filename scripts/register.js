const allowedUsernames = /[^a-zA-Z0-9_]/;
const registerForm = document.querySelector('#register-form');
const usernameInput = document.querySelector('#username');
const usernameExists = document.querySelector('#username-exists');
const passwordInput = document.querySelector('#password');
const confirmPasswordInput = document.querySelector('#confirm-password');
const passwordMatch = document.querySelector('#password-match');
const loginButton = document.querySelector('#login-button');

const isConfirmPasswordValid = () => {
	loginButton.disabled = true;
	if (passwordInput.value === '') {
		confirmPasswordInput.classList.remove('success');
		confirmPasswordInput.classList.remove('error');
		passwordMatch.innerHTML = '';
	} else if (passwordInput.value !== confirmPasswordInput.value) {
		passwordMatch.style.color = 'red';
		passwordMatch.innerHTML = "Password doesn't match";
		confirmPasswordInput.classList.remove('success');
		confirmPasswordInput.classList.add('error');
	} else {
		passwordMatch.innerHTML = '';
		confirmPasswordInput.classList.remove('error');
		confirmPasswordInput.classList.add('success');
		loginButton.disabled = false;
	}
};

const checkUsername = (username, callback) => {
	const xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = () => {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			callback(xmlhttp.responseText);
		}
	};
	xmlhttp.open('GET', `../php/checkusername.php?username=${username}`, true);
	xmlhttp.send();
};

confirmPasswordInput.addEventListener('keyup', (e) => {
	e.preventDefault();
	isConfirmPasswordValid();
});

passwordInput.addEventListener('keyup', (e) => {
	e.preventDefault();
	isConfirmPasswordValid();
});

usernameInput.addEventListener('keyup', (e) => {
	e.preventDefault();
	if (e.target.value === '') {
		e.target.classList.remove('error');
		e.target.classList.remove('success');
		usernameExists.innerHTML = '';
	} else {
		if (allowedUsernames.test(e.target.value)) {
			e.target.classList.remove('success');
			e.target.classList.add('error');
			usernameExists.innerHTML =
				'Username can only consist of alpanumeric and underscore';
		} else {
			const username = e.target.value.trim();
			checkUsername(username, (response) => {
				if (response === '') {
					e.target.classList.remove('error');
					e.target.classList.add('success');
					usernameExists.innerHTML = '';
				} else if (response !== '') {
					e.target.classList.remove('success');
					e.target.classList.add('error');
					usernameExists.innerHTML = response;
				}
			});
		}
	}
});

usernameExists.addEventListener('change', (e) => {
	e.preventDefault();
	if (usernameInput.value === '') {
		usernameInput.classList.remove('error');
		usernameInput.classList.remove('success');
	}
	if (usernameExists.innerHTML === '') {
		usernameInput.classList.remove('error');
		usernameInput.classList.add('success');
	} else {
		usernameInput.classList.remove('success');
		usernameInput.classList.add('error');
	}
});
