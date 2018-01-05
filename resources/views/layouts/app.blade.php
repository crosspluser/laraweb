<!-- 定义布局:文件保存于 resources/views/layouts/app.blade.php -->

<html>
<head>
    <title>应用程序名称 - @yield('title')</title><!--yield显示指定部分的内容。-->
</head>
<body>
@section('sidebar')
    这是主布局的侧边栏。
@show

<div class="container">
    @yield('content')
</div>
</body>
</html>