const Link = /((([A-Za-z]{3,9}:(?:\/\/)?)(?:[\-;:&=\+\$,\w]+@)?[A-Za-z0-9\.\-]+|(?:www\.|[\-;:&=\+\$,\w]+@)[A-Za-z0-9\.\-]+)((?:\/[\+~%\/\.\w\-_]*)?\??(?:[\-\+=&;%@\.\w_]*)#?(?:[\.\!\/\\\w]*))?)/;

function validate() {
    let short = document.getElementById("short");
    let long = document.getElementById("long");

    short.setCustomValidity("");
    long.setCustomValidity("");

    if(!Link.test(long.value)) {
        long.setCustomValidity("Your link is invalid!");
        long.reportValidity();
    }
    else{
        let formData = new FormData();
        formData.append("short", short.value);
        formData.append("long", long.value);

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "/index.php?page=short");
        xhr.send(formData);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200){
                let data = JSON.parse(xhr.responseText);
                if (data.error === 'link'){
                    short.setCustomValidity("There is link with this short form!");
                    short.reportValidity();
                }
                else if (data.error === 'server'){
                    alert('There is something wrong. Please try again later');
                }
                else{
                    document.location.href = '/Short';
                }
            }
        };
    }
}


let formData;
function del(x)
{
    formData = new FormData();
    formData.append("link", x.toString());
    modal()
}

function approve(){
    let pass = document.getElementById('pass');

    if(!pass.value.length >= 8){
        pass.setCustomValidity("Your password is to short!");
        pass.reportValidity();
    }
    else {
        formData.append("password", pass.value);

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "/index.php?page=deleteShort");
        xhr.send(formData);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200){
                console.log(xhr.responseText)
                let data = JSON.parse(xhr.responseText);
                if (data.error === 'auth'){
                    alert('You are not the owner of this link ');
                }
                else if (data.error === 'server'){
                    alert('There is something wrong. Please try again later');
                }
                else{
                    document.location.href = '/Short';
                }
            }
        };
    }
}