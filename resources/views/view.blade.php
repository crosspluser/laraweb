<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
</head>
<body>
<!--<form action="/make/request" method="post">--><!--手动创建验证器-自动重定向-->
<form action="/make/request/with/error" method="post"><!--命名错误包-->
    <!--<form action="/make/request/after" method="post">--><!--验证后钩子-->
    <input name="name" type="text"/>
    <button type="submit">submit</button>
</form>
<!--显示验证错误-->
<div style="color:red">
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{ $errors}}
</div>
</body>
</html>
