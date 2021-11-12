let cookieBox = new bootstrap.Modal(document.getElementById('cookieBox'));

function cookie() {
    if (document.cookie.indexOf('analytics=true') !== -1){
        startAnalytics();
    }
    else if(document.cookie.indexOf('analytics=false') !== -1){}
    else{
        cookieBox.show();
    }
}

function noCookie() {
    document.cookie = 'analytics=false;max-age=604800';
    cookieBox.hide();
}

function allowCookie() {
    document.cookie = 'analytics=true;max-age=604800';
    cookieBox.hide();
    startAnalytics();
}

function startAnalytics() {
    import('/config/analytics.js');
}