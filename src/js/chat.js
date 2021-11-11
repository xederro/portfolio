var msgBox = document.getElementById('msgBox');

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
    .limit(20);



query.onSnapshot(function(snapshot) {
    snapshot.docChanges().forEach(function(change) {
        if (change.type === 'removed') {
            msgBox.removeChild(document.getElementById(change.doc.id));
            msgBox.scrollTop = msgBox.scrollHeight;
        } else {
            var message = change.doc.data();
            let classes;

            if(idOfUser == message.id){
                classes = 'alert-danger ms-auto';
            }
            else {
                classes = 'alert-primary me-auto';
            }

            msgBox.innerHTML +=
                '<div class="m-2 p-2 w-75 '
                + classes
                +'" style="font-size: 1rem" id="'
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
    var message = form[2];
    var nick = form[1];
    var id = form[0];


    nick.setCustomValidity("");
    message.setCustomValidity("");

    if (nick.value.length > 50){
        nick.setCustomValidity('Your nick is too long!');
        nick.reportValidity();
    }
    else if(message.value.length > 500){
        message.setCustomValidity('Your message is too long!');
        message.reportValidity();
    }
    else if(isNaN(id.value)){
        alert('There is something wrong. Please try again later');
    }
    else {
        var data ={
            id: id.value,
            nick: nick.value,
            message: message.value,
            timestamp: firebase.firestore.FieldValue.serverTimestamp()
        };

        firebase.firestore().collection('messages').add(data).catch(function(error) {
            alert('There is something wrong. Please try again later');
        });

        message.value = '';
    }

}