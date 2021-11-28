function validate() {
    let name = document.getElementById("name");
    let password = document.getElementById("password");
    let rpassword = document.getElementById("rpassword");
    let npassword = document.getElementById("npassword");

    name.setCustomValidity("");
    password.setCustomValidity("");
    npassword.setCustomValidity("");
    rpassword.setCustomValidity("");

    if (npassword.value !== rpassword.value){
        rpassword.setCustomValidity("Your passwords don't match!");
        rpassword.reportValidity();
    }
    else if (password.value.length <8){
        password.setCustomValidity("Your password is required!");
        password.reportValidity();
    }
    else if(npassword.value !== 0 && rpassword.value.length !== 0 && npassword.value.length < 8) {
        npassword.setCustomValidity("Your password is to short!");
        npassword.reportValidity();
    }
    else if(npassword.value !== 0 && rpassword.value.length !== 0 && !/[0-9]/.test(npassword.value)) {
        npassword.setCustomValidity("Your password should contain at least one digit!");
        npassword.reportValidity();
    }
    else if(npassword.value !== 0 && rpassword.value.length !== 0 && !/[a-z]/.test(npassword.value)) {
        npassword.setCustomValidity("Your password should contain at least one lower case!");
        npassword.reportValidity();
    }
    else if(npassword.value !== 0 && rpassword.value.length !== 0 && !/[A-Z]/.test(npassword.value)) {
        npassword.setCustomValidity("Your password should contain at least one upper case!");
        npassword.reportValidity();
    }
    else{
        let formData = new FormData();
        formData.append("name", name.value);
        formData.append("password", password.value);
        if(npassword.value !== 0 && rpassword.value.length !== 0) formData.append("npassword", npassword.value);

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "/index.php?page=authUpdate");
        xhr.send(formData);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200){
                let data = JSON.parse(xhr.responseText);
                if (data.error === 'server'){
                    alert('There is something wrong. Please try again later');
                }
                else if (data.error === 'pass'){
                    password.setCustomValidity("Your password is wrong!");
                    password.reportValidity();
                }
                else{
                    document.location.href = '/';
                }
            }
        };
    }
}


