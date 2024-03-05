// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here. Other Firebase libraries
// are not available in the service worker.importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');
/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
*/
firebase.initializeApp({
    apiKey: "AIzaSyApEnoCReOoSN0lxHVVVgE9pO3J4D59y44",
    authDomain: "vinero-11bda.firebaseapp.com",
    projectId: "vinero-11bda",
    storageBucket: "vinero-11bda.appspot.com",
    messagingSenderId: "153374621337",
    appId: "1:153374621337:web:c3468eb8e473b76de20208",
    measurementId: "G-12S8QVCPJW"
});

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {

    let title = payload.notification.title;
    let body = payload.notification.body;
    let icon = '/web/img/vms.png';
    
    return self.registration.showNotification(
        title, { body, icon, icon, data: { url: JSON.parse(response).data.click_action } }
    );
});

self.addEventListener("push", (event) => {
    let response = event.data && event.data.text();

    let title = JSON.parse(response).notification.title;
    let body = JSON.parse(response).notification.body;
    // let icon = JSON.parse(response).notification.image;
    // let image = JSON.parse(response).notification.image;
    let icon = '/web/img/vms.png';

    event.waitUntil(
        self.registration.showNotification(title, { body, icon, icon, data: { url: JSON.parse(response).data.click_action } })
    )
});

self.addEventListener('notificationclick', function(event) {
    event.notification.close();
    event.waitUntil(
        clients.openWindow(event.notification.data.url)
    );
});
