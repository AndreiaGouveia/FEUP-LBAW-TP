let password = document.getElementById('inputPassword');
password.addEventListener('keyup', validatePassword, false);

function validatePassword(other) {

    if (!/^.*(?=.*[A-Z])(?=.*[!@#$&*])(?=.*[0-9]).{8,}$/.test(this.value)) {
        this.classList.add('invalid');
    } else
        this.classList.remove('invalid');
}