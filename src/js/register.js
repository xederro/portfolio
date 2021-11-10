const regMail = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

function validate() {
    let email = document.getElementById("email");
    let name = document.getElementById("name");
    let password = document.getElementById("password");
    let rpassword = document.getElementById("rpassword");

    if (password.value !== rpassword.value){
        rpassword.focus();
    }
    else if (!password.value.length >=8){
        password.focus();
    }
    else if(!regMail.test(email.value.toLowerCase())){
        email.focus();
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
                if (xhr.responseText['error'] === 'email'){
                    email.focus();
                }
                else{
                    document.location.href = '/';
                }
            }
        };
    }
}


