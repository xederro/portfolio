<?php
return "
<html lang='pl'>
<head>
    <title>Your New Password</title>
    <style>
        div{
            background-color: snow;
            text-align: center;
            margin: auto;
        }
        
        a.btn{        
            -webkit-appearance: button;
            -moz-appearance: button;
            appearance: button;
            text-decoration: none;
            width: 100px;
            height: 40px;
            background-color: lightblue;
            color: black;
            margin: auto;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div>
        <img src='https://dawid.j.pl/public/icon/android-icon-192x192.png' alt='Logo'>
        <h2>Push this button to go to site</h2>
        <a href='dawid.j.pl/Reset/$data' class='btn'>Reset Password</a>
        <p>or if it doesnt work try this link: </br><a href='dawid.j.pl/Reset/$data'>dawid.j.pl/Reset/$data</a></br>or try later/again</p>
    </div>
</body>
</html>
";


