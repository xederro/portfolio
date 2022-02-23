const regMail = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

function validate() {
    let email = document.getElementById("email");
    let name = document.getElementById("name");
    let message = document.getElementById("message");

    email.setCustomValidity("");
    name.setCustomValidity("");
    message.setCustomValidity("");

    if(!regMail.test(email.value.toLowerCase())) {
        email.setCustomValidity("Your email is invalid!");
        email.reportValidity();
    }
    else if (name.value.length < 1){
        name.setCustomValidity("Your name is empty");
        name.reportValidity();
    }
    else if(message.value.length < 10) {
        message.setCustomValidity("Your message is to short!");
        message.reportValidity();
    }
    else{
        let formData = new FormData();
        formData.append("email", email.value);
        formData.append("name", name.value);
        formData.append("message", message.value);

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "/index.php?page=contact");
        xhr.send(formData);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200){
                let data = JSON.parse(xhr.responseText);
                if (data.error === 'server'){
                    alert('There is something wrong. Please try again later');
                }
                else{
                    document.location.href = '/';
                }
            }
        };
    }
}


