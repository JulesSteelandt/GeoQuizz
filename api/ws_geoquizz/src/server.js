import {WebSocketServer, WebSocket} from 'ws';

const server = new WebSocketServer({port: 3000, clientTracking: true});

const sendNotificationToAll = (msg) => {
    server.clients.forEach((client_socket) => {
        if (client_socket.readyState === WebSocket.OPEN) {
            client_socket.send(msg);
            console.log("Notification envoyer à tous les joueurs")
        }
    });
};

const receivedMessages = [];

server.on('connection', function connection(client_socket) {
    console.log('Client connected');

    client_socket.on('message', function incoming(message) {
        console.log('Received: %s', message);
        if (receivedMessages.length >= 10) {
            receivedMessages.shift(); // Retirer le premier élément (le plus ancien message)
        }
        receivedMessages.push(message.toString());
        console.log(receivedMessages);
        sendNotificationToAll(message);
    });

    client_socket.on('close', function close() {
        console.log('Client disconnected');
    });
});

