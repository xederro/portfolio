function validate() {
    let ip1 = document.getElementById('ip1');
    let ip2 = document.getElementById('ip2');
    let ip3 = document.getElementById('ip3');
    let ip4 = document.getElementById('ip4');

    if(!isNaN(ip1.value) && !isNaN(ip2.value) && !isNaN(ip3.value) && !isNaN(ip4.value)){
        let ip = ip1.value + "." + ip2.value + "." + ip3.value + "." + ip4.value;
        if (ip.match(/^(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/)){
            window.location.href = "/Geo/" + ip;
        }
        else{
            alert('IP that we received is wrong');
        }
    }
}