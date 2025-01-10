const togglePasswordF = document.querySelector('#togglePasswordF');
const newPwd = document.querySelector('#newPwd');
togglePasswordF.addEventListener('click', function (e) {
    const type = newPwd.getAttribute('type') === 'password' ? 'text' : 'password';
    newPwd.setAttribute('type', type);
    this.innerHTML = `<i class="fa fa-${type === 'password' ? 'eye' : 'eye-slash'}"></i>`;
    console.log('clicked togglePasswordF');
});