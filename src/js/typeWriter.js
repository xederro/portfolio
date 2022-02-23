var app = document.getElementById('typeWriteHeader');

var typewriter = new Typewriter(app, {
    loop: false
});

typewriter.typeString("Hello, I'm Dawud")
    .pauseFor(500)
    .deleteChars(2)
    .typeString('id')
    .pauseFor(2500)
    .start();