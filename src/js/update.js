function validate() {
    let email = document.getElementById("email");
    let name = document.getElementById("name");
    let password = document.getElementById("password");
    let rpassword = document.getElementById("rpassword");
    let npassword = document.getElementById("npassword");

    if (npassword.value !== rpassword.value){
        rpassword.focus();
    }
    else if (!password.value.length >=8){
        password.focus();
    }
    else if (!npassword.value.length >=8){
        password.focus();
    }
    else{
        let formData = new FormData();
        formData.append("name", name.value);
        formData.append("password", password.value);
        formData.append("npassword", npassword.value);

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "/index.php?page=authUpdate");
        xhr.send(formData);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200){
                if (xhr.responseText['error'] === 'server'){
                    email.focus();
                }
                else{
                    document.location.href = '/';
                }
            }
        };
    }
}


