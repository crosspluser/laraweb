{{--引入子视图--}}
@include('view')
@include('view', ['data' => 'include'])
@includeIf('view123', ['data' => 'includeIf'])
@includeWhen($boolean ?? true, 'view', ['data' => 'includeWhen'])
@each('view', [1,2,3], 'data')
{{--你也可以传递第四个参数到 @each 命令。当需要迭代的数组为空时，将会使用这个参数提供的视图来渲染。--}}
@each('view', [], 'data','view')