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

{{--1、插值--}}
{{--文本--}}
@verbatim
<p>Message: {{ msg }}</p>
<p>This will never change: {{* msg }}</p>
<p>{{{ raw_html }}}</p>
@endverbatim

<script type="text/javascript" src="{{asset('js/vue.js')}}"></script>
<script type="text/javascript">

</script>

</body>
</html>
