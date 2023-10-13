'use strict';

function fillData(){
    const myForm = document.getElementById('loginForm')
    const email = document.getElementById('email')
    const password = document.getElementById('password')

    email.value ="gameborad@gmail.com";
    password.value ="123";
    myForm.submit();

    console.log(myForm);
    
}