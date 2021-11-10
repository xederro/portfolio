const regMail = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

function validate() {
    let password = document.getElementById("password");

    if (!password.value.length >= 8){
        password.focus();
    }
    else{
        let formData = new FormData();
        formData.append("password", password.value);

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "/index.php?page=authDelete");
        xhr.send(formData);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200){
                if (xhr.responseText['error'] === 'pass'){
                    password.focus();
                }
                else{
                    document.location.href = '/';
                }
            }
        };
    }
}


