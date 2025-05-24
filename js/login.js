

// Fungsi untuk show/hide password
function showHidePassword() {
    const inputPassword = document.getElementById('password');
    const showIcon = document.getElementById('showPassword');

    if (inputPassword.type === 'password') {
        inputPassword.type = 'text';
        showIcon.classList.remove('fa-eye');
        showIcon.classList.add('fa-eye-slash');
    } else {
        inputPassword.type = 'password';
        showIcon.classList.remove('fa-eye-slash');
        showIcon.classList.add('fa-eye');
    }
}

// Fungsi ganti div (login <-> lupa sandi)
document.addEventListener('DOMContentLoaded', function () {
    const login = document.getElementById('formLoginUsers');
    const forget = document.getElementById('formResetPassword');
    const toggleForget = document.getElementById('switchDiv2');
    const toggleLogin = document.getElementById('switchDiv1');

    toggleForget.addEventListener('click', function (event) {
        event.preventDefault();
        login.style.display = 'none';
        forget.style.display = 'block';
    });

    toggleLogin.addEventListener('click', function (event) {
        event.preventDefault();
        login.style.display = 'block';
        forget.style.display = 'none';
    });
});


// redirect form

document.addEventListener('DOMContentLoaded', function(){
    const formLogin = document.getElementById('loginFormUser');

    const emailUser = 'admin@admin.sch.id';
    const passwordUser = 'admin123';

    formLogin.addEventListener('submit', function(event){
        event.preventDefault(); //agar tidak reload

        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;

        if(email === emailUser && password === passwordUser){
            window.location.href = 'dashboard/index.html';
        } else {
            alert("Email atau Password salah!");
        }

    });
});