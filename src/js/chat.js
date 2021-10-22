var msgBox = document.getElementById('msgBox');


var firebaseConfig = {
    apiKey: "AIzaSyBUa-l4Xod9T7Dtcyf1G4m_yEVZd5FV1Eg",
    authDomain: "chat-99d1b.firebaseapp.com",
    projectId: "chat-99d1b",
    storageBucket: "chat-99d1b.appspot.com",
    messagingSenderId: "117171095111",
    appId: "1:117171095111:web:2bcfb306db0e54302b5362",
    measurementId: "G-4XQBQ0FZ1R"
};

firebase.initializeApp(firebaseConfig);
firebase.analytics();

firebase.auth().signInAnonymously()
    .then(() => {
        // Signed in..
    })
    .catch((error) => {
        console.error('Error while anonymous auth', error);
    });

var query = firebase.firestore()
    .collection('messages')
    .orderBy('timestamp', 'asc')
    .limit(12);



query.onSnapshot(function(snapshot) {
    snapshot.docChanges().forEach(function(change) {
        if (change.type === 'removed') {
            msgBox.removeChild(document.getElementById(change.doc.id));
            msgBox.scrollTop = msgBox.scrollHeight;
        } else {
            var message = change.doc.data();
            msgBox.innerHTML +=
                '<div class="m-2 p-2 alert-primary" style="font-size: 1rem" id="'
                + change.doc.id
                + '"><b style="font-size: 1rem">'
                + message.nick
                + ' at '
                + new Date(message.timestamp.toDate()).toUTCString()
                +' </b><hr class="m-0 p-0">'
                + message.message
                + '</div>';

            msgBox.scrollTop = msgBox.scrollHeight;
        }
    });
});




function sendMsg() {
    var form = document.forms[0];
    var message = form[1];
    var nick = form[0];

    var data ={
        nick: nick.value,
        message: message.value,
        timestamp: firebase.firestore.FieldValue.serverTimestamp()
    };

    firebase.firestore().collection('messages').add(data).catch(function(error) {
        console.error('Error writing new message to database', error);
    });

    message.value = '';
}