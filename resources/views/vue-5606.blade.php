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

<!--基于 Laravel 的 Vue.js 中文学习教程 —— Vue实例-->
<!--http://laravelacademy.org/post/5606.html-->

<div id="test1">
    <p v-if="boolValue">Hello!</p>
</div>
<div id="test2">
    <p v-if="boolValue">Hello!</p>
</div>

<script type="text/javascript" src="{{asset('js/vue.js')}}"></script>
<script type="text/javascript">
    var app1 = new Vue({//每一个Vue.js应用都是通过使用Vue构造器方法创建一个Vue根实例启动：
        el: '#test1',
        data: {
            boolValue: false
        }
    });
    var app2 = new Vue({//每一个Vue.js应用都是通过使用Vue构造器方法创建一个Vue根实例启动：
        el: '#test2',
        data: {
            boolValue: true
        }
    });
</script>


<div id="test3">
    <p>@{{ value }}</p>
</div>

<script type="text/javascript">
    //1、构造器
    ///每一个Vue.js应用都是通过使用Vue构造器方法创建一个Vue根实例启动：
    var app3 = new Vue({
        el: '#test3',
        data: {
            value: 'app3 value'
        }
    });
    console.log(app3.value);

    //Vue实例可以通过预定义选项进行扩展，从而创建可复用的组件构造器：
    var MyComponent = Vue.extend({
// extension options
    });

    //尽管你可以创建扩展实例，但是在大多数情况下你需要以自定义元素的方式注册组件构造器，然后在模板中对它们进行组合。我们会在后续章节讨论组件系统的细节，现在，你只需要知道所有的Vue.js组件都是继承自Vue实例即可。
    // all instances of `MyComponent` are created with
    // the pre-defined extension options
    var myComponentInstance = new MyComponent();
</script>

<script type="text/javascript">

    //2、属性和方法
    //除了数据属性之外，Vue实例还提供了许多有用的实例属性和方法，这些属性和方法都以$开头以便和代理数据属性进行区分。例如：
    console.log(app3.$el);
    watch = app3.$watch('value', function (newVal, oldVal) {
        // this callback will be called when `vm.a` changes
        console.log('this callback will be called when `vm.a` changes');
    });

    //3、实例生命周期
    var app4 = new Vue({
        data: {
            a: 1
        },
        //3、实例生命周期
        //钩子就是中间件
        created: function () {
            // `this` points to the vm instance
            console.log('a is: ' + this.a)
        }
    });


</script>


</body>
</html>
