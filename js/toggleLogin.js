// Description: This file contains the javascript code to toggle between login and signup forms.

/**
 * Function to show login form and hide signup form
 */
function toggleLogin() {
    const loginDiv = document.getElementById('login_div');
    const signupDiv = document.getElementById('sign_up_div');
    loginDiv.style.display = 'block';
    signupDiv.style.display = 'none';
    console.log('login');
}

/**
 * Function to show signup form and hide login form
 */
function toggleSignup() {
    const loginDiv = document.getElementById('login_div');
    const signupDiv = document.getElementById('sign_up_div');
    loginDiv.style.display = 'none';
    signupDiv.style.display = 'block';
    console.log('signup');
}