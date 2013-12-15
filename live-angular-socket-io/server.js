var http = require('http');

httpServer = http.createServer(function (request, result) {});

httpServer.listen(1337);

var io = require('socket.io').listen(httpServer);

var users = {};
var messages = new Array();

io.sockets.on('connection', function(socket){
    console.log("connection");

    var me;

    socket.on('authenticate', function(pseudo) {
        if ('' == pseudo) {
            return;
        };

        console.log("authenticate : " + pseudo);

        users[pseudo] = {
            'pseudo': pseudo
        };
        me = pseudo;

        io.sockets.emit('update.users', users);
    });

    socket.on('disconnect', function() {
        delete users[me];
        io.sockets.emit('update.users', users);
    });

    socket.on('new.message', function(message) {
        messages.push({
            'message': message,
            'user': me
        });

        io.sockets.emit('add.message', {
            'message': message,
            'user': me
        });
    });
});

