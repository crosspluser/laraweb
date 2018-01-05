<!--不需要extends,会根据component名称找到同名模板,然后填入模板内的slot变量-->
@component('alert2')
    <!--slot会找到模板内的响应变量,填入-->
    @slot('title')
        Forbidden
    @endslot

    你没有权限访问这个资源！
@endcomponent