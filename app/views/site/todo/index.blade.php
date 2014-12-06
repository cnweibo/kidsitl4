@extends('site.layouts.default')
@section('title')
    todo web application
    @parent
@stop
@section('keywords')
    todolist
@stop
@section('description') 
    todo app
    @parent
@stop
@section('css')
    <link rel="stylesheet" href={{ asset('htmlapp/todoApp/assets/base.css')}}>
    <link rel="stylesheet" href={{ asset('htmlapp/libs/angular-busy/dist/angular-busy.css')}}>

@stop
@section('bodyhead')
<body ng-app="todomvc" data-framework="angularjs">
@overwrite
@section('content')
<div class="container">
    <section id="todoapp" ng-controller="TodoCtrl">
        <div cg-busy="getAllPromise"></div>
        <header id="header">
            <h1>todos</h1>
            <form id="todo-form" ng-submit="addTodo()">
                <input id="new-todo" placeholder="What needs to be done?" ng-model="newTodo" autofocus>
            </form>
        </header>
        <section id="main" ng-show="todos.length" ng-cloak>
            <input id="toggle-all" type="checkbox" ng-model="allChecked" ng-click="markAll(allChecked)">
            <label for="toggle-all">Mark all as complete</label>
            <ul id="todo-list">
                <li ng-repeat="todo in todos | filter:statusFilter track by $index" ng-class="{completed: todo.completed, editing: todo == editedTodo}">
                    <div class="view">
                        <input class="toggle" type="checkbox" ng-model="todo.completed" ng-change="todoCompleted(todo)">
                        <label ng-dblclick="editTodo(todo)">[[todo.title]]</label>
                        <button class="destroy" ng-click="removeTodo(todo)"></button>
                    </div>
                    <form ng-submit="doneEditing(todo)">
                        <input class="edit" ng-trim="false" ng-model="todo.title" ng-blur="doneEditing(todo)" todo-escape="revertEditing(todo)" todo-focus="todo == editedTodo">
                    </form>
                </li>
            </ul>
        </section>
        <footer id="footer" ng-show="todos.length" ng-cloak>
    				<span id="todo-count"><strong>[[remainingCount]]</strong>
    					<ng-pluralize count="remainingCount" when="{ one: 'item left', other: 'items left' }"></ng-pluralize>
    				</span>
            <ul id="filters">
                <li>
                    <a ng-class="{selected: location.path() == '/'} " href="#/">All</a>
                </li>
                <li>
                    <a ng-class="{selected: location.path() == '/active'}" href="#/active">Active</a>
                </li>
                <li>
                    <a ng-class="{selected: location.path() == '/completed'}" href="#/completed">Completed</a>
                </li>
            </ul>
            <button id="clear-completed" ng-click="clearCompletedTodos()" ng-show="remainingCount < todos.length">Clear completed ([[todos.length - remainingCount]])</button>
        </footer>
    </section>
</div>
@stop
@section('scripts')


    <script type="text/javascript" src="{{asset('dist/appTodo.min.js')}}"></script>


    @include('phptojsvariables')
@stop