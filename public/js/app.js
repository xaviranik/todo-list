var app = new Vue({
    el: '#app',
    data() {
        return {
            newTodo: '',
            cachedTodo: '',
            filter: 'all',
            todos: [],
        }
    },
    created() {
        this.getTodos();
    },
    computed: {
        todoCount() {
            return this.todos.length
        },
        showTodoBody() {
            return this.todoCount != 0
        },
        remainingTodo() {
            return this.todos.filter(todo => !todo.completed).length
        },
        anyRemainingTodo() {
            return this.remainingTodo != 0
        },
        filteredTodos() {
            if (this.filter == 'all') {
                return this.todos
            } else if (this.filter == 'active') {
                return this.todos.filter(todo => !todo.completed)
            } else if (this.filter == 'completed') {
                return this.todos.filter(todo => todo.completed)
            }
            return this.todos
        },
        showClearCompletedButton() {
            return this.todos.filter(todo => todo.completed).length > 0
        },
    },
    directives: {
        focus: {
            inserted: function (el) {
                el.focus()
            }
        }
    },
    methods: {
        getTodos() {
            axios.get('http://todo-list.test/backend/api/todo')
                .then((response) => {
                    if(response.data.message == "No Todos Found")
                    {
                        this.todos = []
                        return
                    }
                    response.data.forEach(todo => {
                        todo.editing = false
                    });
                    this.todos = response.data
                })
                .catch((error) => {
                    console.log(error)
                })
        },
        createTodo() {
            if (this.newTodo.trim().length == 0) {
                return
            }
            let newTodoObj = {
                title: this.newTodo
            }
            axios.post('http://todo-list.test/backend/api/todo/create.php', newTodoObj)
                .then((response) => {
                    this.getTodos();
                })
                .catch((error) => {
                    console.log(error)
                })
            this.newTodo = ''
        },
        editTodo(todo) {
            this.cachedTodo = todo.title
            todo.editing = true
        },
        updateTodo(todo) {
            if (todo.title.trim() == '') {
                todo.title = this.cachedTodo
            }
            let updateTodoObj = {
                id: todo.id,
                title: todo.title,
                completed: todo.completed ? 1 : 0
            }
            axios.put('http://todo-list.test/backend/api/todo/update.php', updateTodoObj)
                .then((response) => {
                    this.getTodos();
                })
                .catch((error) => {
                    console.log(error)
                })
            todo.editing = false
        },
        cancelEdit(todo) {
            todo.title = this.cachedTodo
            todo.editing = false
        },
        deleteTodo(todo) {
            axios.post('http://todo-list.test/backend/api/todo/delete.php', {
                id: todo.id
            })
            .then((response) => {
                this.getTodos();
            })
            .catch((error) => {
                console.log(error)
            })
        },
        completeAllTodos() {
            this.todos.forEach((todo) => {
                todo.completed = event.target.checked
                this.updateTodo(todo)
            })
        },
        clearCompleted() {
            let completedTodos = this.todos.filter(todo => todo.completed)
            completedTodos.forEach((todo) => {
                this.deleteTodo(todo)
            })

        }
    }
})