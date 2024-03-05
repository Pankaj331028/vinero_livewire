
var firebaseConfig = {
    apiKey: "AIzaSyDqwkqcBusUbYxN9rwB9Qn1DJi8QQf4sTo",
    authDomain: "vinero-vlcare.firebaseapp.com",
    databaseURL: 'https://vinero-vlcare-default-rtdb.firebaseio.com/',
    projectId: "vinero-vlcare",
    storageBucket: "vinero-vlcare.appspot.com",
    messagingSenderId: "927616492145",
    appId: "1:927616492145:web:a22d83533b3035394171d0",
    measurementId: "G-8VVYCWRLDK"
};
firebase.initializeApp(firebaseConfig);
const messaging = firebase.messaging();
function startFCM() {
    messaging
        .requestPermission()
        .then(function () {
            return messaging.getToken()
        })
        .then(function (response) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ route("store.token") }}',
                type: 'POST',
                data: {
                    token: response
                },
                dataType: 'JSON',
                success: function (response) {
                    alert('Token stored.');
                },
                error: function (error) {
                    alert(error);
                },
            });
        }).catch(function (error) {
            alert(error);
        });
}
messaging.onMessage(function (payload) {
    const title = payload.notification.title;
    const options = {
        body: payload.notification.body,
        icon: payload.notification.icon,
        image: payload.notification.image,
    };
    new Notification(title, options);

});
