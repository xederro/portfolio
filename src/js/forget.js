const regMail = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

function validate() {
    let email = document.getElementById("email");

    email.setCustomValidity("");

    if(!regMail.test(email.value.toLowerCase())){
        email.setCustomValidity("Your email is invalid!");
        email.reportValidity();
    }
    else {
        let formData = new FormData();
        formData.append("email", email.value);

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "/index.php?page=authForget");
        xhr.send(formData);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200){
                let data = JSON.parse(xhr.responseText);
                console.log(data);
                if (data.error === 'server'){
                    alert('There is something wrong. Please try again later');
                }
                else if (data.error === 'email'){
                    email.setCustomValidity("Your email is wrong!");
                    email.reportValidity();
                }
                else if (data.error === 'token'){
                    alert('There is something wrong. Please try again later');
                }
                else{
                    document.location.href = '/';
                }
            }
        };
    }
}


