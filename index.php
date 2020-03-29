<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    <link rel="shortcut icon" href="https://img.icons8.com/bubbles/50/000000/edit.png" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <link rel="stylesheet" href="public/css/app.css">
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
</head>

<body>
    <div id="app">
        <div class="container">
            <div class="row justify-content-center">
                <h1 class="my-4 site-title">Todo List</h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div>
                                <div class="card card-inside">
                                    <input type="text" class="todo-input" placeholder="What's the plan today?" v-model="newTodo" @keyup.enter="createTodo">
                                </div>

                                <div v-if="showTodoBody" class="mt-4">
                                    <transition-group name="fade" enter-active-class="animated fadeInUp" leave-active-class="animated fadeOutDown">
                                        <div v-for="(todo, index) in filteredTodos" :key="todo.id" class="todo-item">
                                            <div class="todo-item-left">
                                                <input type="checkbox" v-model="todo.completed" @change="updateTodo(todo)">
                                                <div v-if="!todo.editing" @dblclick="editTodo(todo)" class="todo-item-label" :class="{ completed : todo.completed }">{{ todo.title }}</div>
                                                <input v-else class="todo-item-edit" type="text" v-model="todo.title" @blur="updateTodo(todo)" @keyup.enter="updateTodo(todo)" @keyup.esc="cancelEdit(todo)" v-focus>

                                            </div>
                                            <div class="remove-item" @click="deleteTodo(todo)">
                                                <svg height="16pt" viewBox="-40 0 427 427.001" width="16pt">
                                                    <path d="M232.398 154.703c-5.523 0-10 4.477-10 10v189c0 5.52 4.477 10 10 10 5.524 0 10-4.48 10-10v-189c0-5.523-4.476-10-10-10zm0 0M114.398 154.703c-5.523 0-10 4.477-10 10v189c0 5.52 4.477 10 10 10 5.524 0 10-4.48 10-10v-189c0-5.523-4.476-10-10-10zm0 0" />
                                                    <path d="M28.398 127.121V373.5c0 14.563 5.34 28.238 14.668 38.05A49.246 49.246 0 0 0 78.796 427H268a49.233 49.233 0 0 0 35.73-15.45c9.329-9.812 14.668-23.487 14.668-38.05V127.121c18.543-4.922 30.559-22.836 28.079-41.863-2.485-19.024-18.692-33.254-37.88-33.258h-51.199V39.5a39.289 39.289 0 0 0-11.539-28.031A39.288 39.288 0 0 0 217.797 0H129a39.288 39.288 0 0 0-28.063 11.469A39.289 39.289 0 0 0 89.398 39.5V52H38.2C19.012 52.004 2.805 66.234.32 85.258c-2.48 19.027 9.535 36.941 28.078 41.863zM268 407H78.797c-17.098 0-30.399-14.688-30.399-33.5V128h250v245.5c0 18.813-13.3 33.5-30.398 33.5zM109.398 39.5a19.25 19.25 0 0 1 5.676-13.895A19.26 19.26 0 0 1 129 20h88.797a19.26 19.26 0 0 1 13.926 5.605 19.244 19.244 0 0 1 5.675 13.895V52h-128zM38.2 72h270.399c9.941 0 18 8.059 18 18s-8.059 18-18 18H38.199c-9.941 0-18-8.059-18-18s8.059-18 18-18zm0 0" />
                                                    <path d="M173.398 154.703c-5.523 0-10 4.477-10 10v189c0 5.52 4.477 10 10 10 5.524 0 10-4.48 10-10v-189c0-5.523-4.476-10-10-10zm0 0" />
                                                </svg>
                                            </div>
                                        </div>
                                    </transition-group>

                                    <div class="extra-container">
                                        <div>
                                            <label class="font-sm">
                                                <input type="checkbox" :checked="!anyRemainingTodo" @change="completeAllTodos">
                                                Complete all todo
                                            </label>
                                        </div>
                                        <div class="font-sm">{{ remainingTodo }} items left</div>
                                    </div>

                                    <div class="extra-container">
                                        <div>
                                            <button :class="{ active: filter == 'all' }" @click="filter = 'all'">All</button>
                                            <button :class="{ active: filter == 'active' }" @click="filter = 'active'">Active</button>
                                            <button :class="{ active: filter == 'completed' }" @click="filter = 'completed'">Completed</button>
                                        </div>

                                        <div>
                                            <transition name="fade">
                                                <button v-if="showClearCompletedButton" @click="clearCompleted">Clear
                                                    Completed</button>
                                            </transition>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="public/js/app.js"></script>
</body>

</html>