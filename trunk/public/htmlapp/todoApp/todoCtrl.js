/*global todomvc, angular */
/*jslint node: true */
'use strict';

/**
 * The main controller for the app. The controller:
 * - retrieves and persists the model via the todoStorage service
 * - exposes the model to the template and provides event handlers
 */
todomvc.controller('TodoCtrl', function TodoCtrl($scope, $location, $filter, todoStorage,$window) {
    var todos;
    var promise;
    $scope.getAllPromise = promise = todoStorage.getAll();
        promise.then(
            function(todosdata) {/*success*/
                    todos = $scope.todos = todosdata;
                    $scope.remainingCount = $filter('filter')(todos, {completed: false}).length;
                },
            function(status) {console.log("error status code:"+status);}
        );
    $scope.newTodo = '';

    $scope.editedTodo = null;

    if ($location.path() === '') {
        $location.path('/');
    }
    $scope.csrf_token = $window.csrf_token;
    $scope.location = $location;

    $scope.$watch('location.path()', function (path) {
        $scope.statusFilter = { '/active': {completed: false}, '/completed': {completed: true} }[path];
    });

    $scope.$watch('remainingCount == 0', function (val) {
        $scope.allChecked = val;
    });

    $scope.addTodo = function () {
        var newTodo = $scope.newTodo.trim();
        if (newTodo.length === 0) {
            return;
        }

        todos.push({
            title: newTodo,
            completed: false
        });
        todoStorage.put({
            title: newTodo,
            completed: false,
            _token: $scope.csrf_token
        });

        $scope.newTodo = '';
        $scope.remainingCount++;
    };

    $scope.editTodo = function (todo) {
        $scope.editedTodo = todo;
        // Clone the original todo to restore it on demand.
        $scope.originalTodo = angular.extend({}, todo);
    };

    $scope.doneEditing = function (todo) {
        $scope.editedTodo = null;
        todo.title = todo.title.trim();

        if (!todo.title) {
            $scope.removeTodo(todo);
        }

        todoStorage.put(
            {
                title: todo.title,
                _token: $scope.csrf_token
            }
        );
    };

    $scope.revertEditing = function (todo) {
        todos[todos.indexOf(todo)] = $scope.originalTodo;
        $scope.doneEditing($scope.originalTodo);
    };

    $scope.removeTodo = function (todo) {
        $scope.remainingCount -= todo.completed ? 0 : 1;
        todos.splice(todos.indexOf(todo), 1);
        todoStorage.put(todos);
    };

    $scope.todoCompleted = function (todo) {
        $scope.remainingCount += todo.completed ? -1 : 1;
        todoStorage.put(todos);
    };

    $scope.clearCompletedTodos = function () {
        $scope.todos = todos = todos.filter(function (val) {
            return !val.completed;
        });
        todoStorage.put(todos);
    };

    $scope.markAll = function (completed) {
        todos.forEach(function (todo) {
            todo.completed = !completed;
        });
        $scope.remainingCount = completed ? todos.length : 0;
        todoStorage.put(todos);
    };
});