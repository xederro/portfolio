const regMail = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

function validate() {
    let email = document.getElementById("email");
    let password = document.getElementById("password");

    if(!regMail.test(email.value.toLowerCase())){
        email.focus();
    }
    else if(!password.value.length >= 8){
        email.focus();
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
                if (xhr.responseText['error'] === 'email'){
                    console.log(xhr.responseText)
                    email.focus();
                }
                else if (xhr.responseText['error'] === 'pass'){
                    console.log(xhr.responseText)
                    password.focus();
                }
                else{
                    document.location.href = '/';
                }
            }
        };
    }
}

