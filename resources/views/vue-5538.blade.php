<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->

    <!-- Styles -->
</head>
<body>

<script type="text/javascript" src="{{asset('js/vue.js')}}"></script>

<!--单向绑定-->
<div class="container">
    <div class="content">
        <div class="title1">
            <p>@{{ message }}</p>
        </div>
    </div>
</div>
<script type="text/javascript">
    new Vue({
        el: '.title1',
        data: {
            message: 'Hello Vue!'
        }
    })
</script>


<!--双向绑定-->
<div class="container">
    <div class="content">
        <div class="title2">
            <p>@{{ message }}</p>
            <input v-model="message">
        </div>
    </div>
</div>
<script type="text/javascript">
    new Vue({
        el: '.title2',
        data: {
            message: 'Hello Vue!'
        }
    })
</script>


<!--渲染列表-->
<div class="content">
    <div class="title3">
        <ul>
            <li v-for="todo in todos">
                @{{ todo.text }}
            </li>
        </ul>
    </div>
</div>
<script type="text/javascript">
    new Vue({
        el: '.title3',
        data: {
            todos: [
                {text: 'Learn Laravel'},
                {text: 'Learn Vue.js'},
                {text: 'At LaravelAcademy.org'}
            ]
        }
    })
</script>


<!--处理用户点击-->
<div class="content">
    <div class="title4">
        <p>@{{ message }}</p>
        <button v-on:click="reverseMessage">反转消息</button>
    </div>
</div>
<script type="text/javascript">
    new Vue({
        el: '.title4',
        data: {
            message: 'Hello Laravel!'
        },
        methods: {
            reverseMessage: function () {
                this.message = this.message.split('').reverse().join('')
            }
        }
    })
</script>

<!--综合示例-->
<div class="content5">
    <input v-model="newTodo" v-on:keyup.enter="addTodo">
    <ul>
        <li v-for="todo in todos">
            <span>@{{ todo.text }}</span>
            <button v-on:click="removeTodo($index)">X</button>
        </li>
    </ul>
</div>
<script type="text/javascript">
    new Vue({
        el: '.content5',
        data: {
            newTodo: '',
            todos: [
                {text: '新增todos'}
            ]
        },
        methods: {
            addTodo: function () {
                var text = this.newTodo.trim()
                if (text) {
                    this.todos.push({text: text})
                    this.newTodo = ''
                }
            },
            removeTodo: function (index) {
                console.log(index);
                //index有错误,等用到再解决. 原链接 http://laravelacademy.org/post/5538.html
                this.todos.splice(index, 1)
            }
        }
    })
</script>

</body>
</html>
