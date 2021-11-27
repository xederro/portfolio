function validate() {
    let formData = new FormData();

    let xhr = new XMLHttpRequest();
    xhr.open("POST", window.location.href);
    xhr.send(formData);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200){
            let data = JSON.parse(xhr.responseText);
            console.log(data);
            if (data.error === 'server'){
                alert('There is something wrong. Please try again later');
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


