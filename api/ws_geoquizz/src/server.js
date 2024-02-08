import {WebSocketServer} from 'ws';

const server = new WebSocketServer({port: 3000, clientTracking: true});

const sendNotificationToAll = (msg) => {
    server.clients.forEach((client_socket) => {
        if (client_socket.readyState === WebSocket.OPEN) {
            client_socket.send(msg);
        }
    });
};

//const clients = [{clientSocket : ...., numCommande: ....} ]
const clients = []

server.on('connection', function connection(client_socket) {
    console.log('Client connected');

    client_socket.on('message', function incoming(message) {
        console.log('Received: %s', message);

        clients.push(client_socket)

        client_socket.addEventListener('message', (message) => {
            clients.push({clientSocket: client_socket, numCommande : message.data})
            client_socket.send('Partie ok');
        });

        client_socket.on('close', function close() {
            console.log('Client disconnected');
            const index = clients.indexOf(client_socket);
            if (index > -1) {
                clients.splice(index, 1);
            }
        });
    });
});

server.on('message', function(message) {
    console.log('message envoyer : ' + message);
    sendNotificationToAll(message);
});
