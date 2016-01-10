angular.module('chat', [
    'ngRoute',
    'socketModule'
])

.config(function($routeProvider) {
    $routeProvider.when('/login', {
        templateUrl: 'views/login.html',
        controller: 'LoginCtrl'
    });

    $routeProvider.when('/chat', {
        templateUrl: 'views/chat.html',
        controller: 'ChatCtrl'
    });

    $routeProvider.otherwise({
        redirectTo: '/login'
    });
})

.factory("loggedUser", function() {
  return {
        pseudo: ''
    }
})

.controller('LoginCtrl', function LoginCtrl($scope, loggedUser, $location) {
    $scope.pseudo = loggedUser.pseudo;

    $scope.submit = function(formLogin) {
        if (formLogin.$valid) {
            loggedUser.pseudo = $scope.pseudo;
            $location.path("/chat");
        }
    }
})

.controller('ChatCtrl', function ChatCtrl($scope, loggedUser, $location, socket) {
    if ('' == loggedUser.pseudo) {
        $location.path("/login");
        return;
    }

    socket.emit('authenticate', loggedUser.pseudo);

    $scope.users = new Array();

    socket.on('update.users', function(users) {
        $scope.users = users;
    });

    $scope.message = '';

    $scope.send = function(formMessage) {
        if (formMessage.$valid) {
            socket.emit('new.message', $scope.message);
            $scope.message = '';
        }
    };

    $scope.messages = new Array();

    socket.on('add.message', function(message) {
        $scope.messages.push(message);
    });
})

.directive('message', [function(){
    return {
        restrict: 'E',
        templateUrl: 'views/message.html',
        require: 'msg',
        scope: {
            msg: '='
        }
    };
}]);
;
