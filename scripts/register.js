const allowedUsername = /([a-zA-Z0-9_])/;
const registerForm = document.querySelector('#register-form');
const usernameInput = document.querySelector('#username');
const passwordInput = document.querySelector('#password');
const confirmPasswordInput = document.querySelector('#confirm-password');

const isUsernameValid = (username) => {
	return username.trim().match(allowedUsername);
};

usernameInput.addEventListener('change', (e) => {
	if (e.target.value === 'hahaha') {
		usernameInput.classList.remove('error');
		usernameInput.classList.add('success');
	} else {
		usernameInput.classList.add('error');
	}
});

usernameInput.addEventListener('focus', (e) => {});
