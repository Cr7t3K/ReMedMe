self.addEventListener('push', function (event) {
    if (!(self.Notification && self.Notification.permission === 'granted')) {
        return;
    }

    const sendNotification = payload => {
        // you could refresh a notification badge here with postMessage API
        //const title = "HEY! Voici le résultat du push. C'est pas ouf mais quand-même !";
        payload = JSON.parse(payload);

        return self.registration.showNotification(payload.title, {
            body: payload.message,
            image: payload.img
        });
    };

    if (event.data) {
        const message = event.data.text();
        event.waitUntil(sendNotification(message));
    }
});
