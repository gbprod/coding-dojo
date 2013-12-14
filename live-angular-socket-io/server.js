var http = require('http');

httpServer = http.createServer(function (request, result) {});

httpServer.listen(1337);

var io = require('socket.io').listen(httpServer);

io.sockets.on('connection', function(socket){
    console.log("connection");
});

