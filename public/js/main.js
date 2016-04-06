var app = angular.module("todoApp", []);

app.controller('todoContoller', function($http){

    var todoEdit = null;
    var currentTodos = this;
    this.button = 'Add todo';
    /**
     * fetch all todos
     */
    $http.get('/todos').success(function (todos) {

        currentTodos.todos = todos;
    });
    /**
     * get the number of incomplete todos
     * @returns {number}
     */
    this.remaining = function(){
        var count = 0;

        angular.forEach(this.todos, function(todo){
            count += todo.completed ? 0 : 1;
        });

        return count;
    }

    /**
     * Add/Update a todo
     */
    this.addTodo = function(){

        if (todoEdit != null) {
            todoEdit.body = this.newText;
            todo = todoEdit;
            todoEdit = null;
        } else {
            var todo = {
                body: this.newText,
                completed: false
            };
        }

        $http.post('todos', todo).success(function(todo){
            if(todo){
                currentTodos.todos.push(todo);
            }
        });
        this.button = 'Add todo';
        this.newText = '';
    };
    /**
     * Update a todo
     * @param todo
     */
    this.update = function(todo){
        this.button = 'Update todo';
        todoEdit = todo;
        this.newText = todo.body;
    };

    /**
     * Mark/unmark the todo as complete
     * @param todo
     */
    this.toggleCb = function (todo) {
        $http.post('todos', todo);
    };

    /**
     * Delete a todo
     * @param todo
     */
    this.deleteTodo = function(todo) {
        $http.delete('todos', {params: todo}).success(function(){
            currentTodos.todos = currentTodos.todos.filter(function(item){
                return item.id !== todo.id;
            });
        });
    }
});
