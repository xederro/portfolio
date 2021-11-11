const regMail = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

function validate() {
    let email = document.getElementById("email");
    let password = document.getElementById("password");

    password.setCustomValidity("");
    email.setCustomValidity("");

    if(!regMail.test(email.value.toLowerCase())){
        email.setCustomValidity("Your email is invalid!");
        email.reportValidity();
    }
    else if(!password.value.length >= 8){
        password.setCustomValidity("Your password is to short!");
        password.reportValidity();
    }
    else{
        let formData = new FormData();
        formData.append("email", email.value);
        formData.append("password", password.value);

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "/index.php?page=authLogin");
        xhr.send(formData);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200){
                let data = JSON.parse(xhr.responseText);
                if (data.error === 'email'){
                    email.setCustomValidity("Your email is invalid!");
                    email.reportValidity();
                }
                else if (data.error === 'pass'){
                    password.setCustomValidity("Your password is wrong!");
                    password.reportValidity();
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

