<!--不需要extends,会根据component名称找到同名模板,然后填入模板内的slot变量-->
<!--还可以用数组传值-->
<!--在抛出错误时很有用,只用关心错误内容,不用到处重复设置错误样式-->
@component('alert',['key'=>'value'])
    <strong>Whoops!</strong> Something went wrong!
@endcomponent