<!DOCTYPE html>
<html ng-app="todoApp" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
    <head lang="en">
        <meta charset="UTF-8">
        <title>Todo</title>
        <style>
            small{
                font-size: .8em;
                font-style:italic;
            }
        </style>
        <link href="css/bootstrap.min.css" type="text/css" rel="stylesheet">
    </head>

    <body ng-controller="todoContoller as td" class="col-md-12">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-5"> Todo
                    <small ng-if="td.remaining()"> ({{ td.remaining() }} remaining) </small>
                    <small ng-if="!td.remaining()"> (All done!! You Completed All your tasks...) </small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <input type="text" ng-model="search" placeholder="Filter/Search todo">
    </div>
        <br/>
        <table class="col-md-8">
            <tr ng-repeat="todo in td.todos | filter: search">
                <td>  <input type="checkbox" ng-model="todo.completed" ng-click="td.toggleCb(todo)">  </td>
                <td>  <a href="" ng-click="td.update(todo)"> {{todo.body}} </a></td>
                <td>  <button type="button" ng-click="td.deleteTodo(todo)">X</button>  </td>
            </tr>
        </table>
    <div class="col-md-8">
        <br/>
        <form ng-submit="td.addTodo()">
            <input type="text" placeholder="Add a Todo" ng-model="td.newText">
            <input type="hidden" ng-model="td.itemId">
            <button type="submit">{{td.button}}</button>
            <button type="reset">Cancel</button>
        </form>
    </div>
        <script src="<?php echo asset('js/angular.min.js') ?>"></script>
        <script src="<?php echo asset('js/main.js') ?>"></script>
        <script src="<?php echo asset('js/bootstrap.min.js') ?>"></script>
    </body>
</html>