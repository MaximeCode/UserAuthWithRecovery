const togglePassword = document.getElementById('togglePassword');
const password = document.getElementById('password');
togglePassword.addEventListener('click', function (e) {
    console.log('clicked togglePassword');
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye / eye slash icon
    this.innerHTML = `<i class="fa fa-${type === 'password' ? 'eye' : 'eye-slash'}"></i>`;
});

const togglePasswordS = document.getElementById('togglePasswordS');
const passwordS = document.getElementById('passwordS');
togglePasswordS.addEventListener('click', function (e) {
    console.log('clicked togglePasswordS');
    // toggle the type attribute
    const type = passwordS.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordS.setAttribute('type', type);
    // toggle the eye / eye slash icon
    this.innerHTML = `<i class="fa fa-${type === 'password' ? 'eye' : 'eye-slash'}"></i>`;
});