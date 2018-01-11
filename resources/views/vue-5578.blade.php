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

<!-- DOM 视图 -->

<div id="example-1">
    Hello @{{ name }}!
</div>
<script type="text/javascript">
    // 数据模型
    var exampleData = {
        name: 'LaravelAcademy.org'
    };

    // 创建一个Vue实例绑定视图和数据
    var exampleVM = new Vue({
        el: '#example-1',
        data: exampleData
    });
</script>

<!-- 反应式数据绑定 -->
<div id="example-2">
    <p v-if="greeting">Hello!</p>
</div>
<script type="text/javascript">
    var exampleVM2 = new Vue({
        el: '#example-2',
        data: {
            greeting: true
        }
    })
</script>

<!--组件系统-->
<div id="app">
    <app-nav></app-nav>
    <app-view>
        <app-sidebar></app-sidebar>
        <app-content></app-content>
    </app-view>
</div>


</body>
</html>
