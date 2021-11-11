const regMail = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

function validate() {
    let email = document.getElementById("email");
    let name = document.getElementById("name");
    let password = document.getElementById("password");
    let rpassword = document.getElementById("rpassword");

    email.setCustomValidity("");
    name.setCustomValidity("");
    password.setCustomValidity("");
    rpassword.setCustomValidity("");

    if(!regMail.test(email.value.toLowerCase())) {
        email.setCustomValidity("Your email is invalid!");
        email.reportValidity();
    }
    else if (password.value !== rpassword.value){
        rpassword.setCustomValidity("Your passwords don't match!");
        rpassword.reportValidity();
    }
    else if (name.value.length < 1){
        name.setCustomValidity("Your name is empty");
        name.reportValidity();
    }
    else if(password.value.length < 8) {
        password.setCustomValidity("Your password is to short!");
        password.reportValidity();
    }
    else if(!/[0-9]/.test(password.value)) {
        password.setCustomValidity("Your password should contain at least one digit!");
        password.reportValidity();
    }
    else if(!/[a-z]/.test(password.value)) {
        password.setCustomValidity("Your password should contain at least one lower case!");
        password.reportValidity();
    }
    else if(!/[A-Z]/.test(password.value)) {
        password.setCustomValidity("Your password should contain at least one upper case!");
        password.reportValidity();
    }
    else{
        let formData = new FormData();
        formData.append("email", email.value);
        formData.append("name", name.value);
        formData.append("password", password.value);

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "/index.php?page=authRegister");
        xhr.send(formData);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200){
                let data = JSON.parse(xhr.responseText);
                if (data.error === 'email'){
                    email.setCustomValidity("There is user with this email!");
                    email.reportValidity();
                }
                else if (data.error === 'server'){
                    alert('There is something wrong. Please try again later');
                }
                else{
                    document.location.href = '/';
                }
            }
        };
    }
}


