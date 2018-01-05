<!--注释:此注释会出现在渲染后的HTML-->
{{-- 此注释将不会出现在渲染后的 HTML,这是blade注释的格式 --}}

@if (count($array) === 1)
    我有一条记录！<br />
@elseif (count($array) > 1)
    我有多条记录！<br />
@else
    我没有任何记录！<br />
@endif

@unless (Auth::check())
    你尚未登录。
    <br />
@endunless

@isset($array)
    // $array 被定义并且不为空...
    <br />
@endisset

@empty($array)
    // $array 是「空」的...
    <br />
@endempty

@auth
    // 用户已经通过身份认证...
    <br />
@endauth

@guest
    // 用户没有通过身份认证...
    <br />
@endguest

@switch($var)
    @case(1)
    First case...    <br />
    @break

    @case(2)
    Second case...    <br />
    @break

    @default
    Default case...    <br />
@endswitch

@for ($i = 0; $i < 10; $i++)
    目前的值为 {{ $i }} <br />
@endfor

@foreach ($users as $user)
    <p>此用户为 {{ $user->id }}</p>
@endforeach

<!--foreach与if else的联合使用-->
@forelse ($users as $user)
    <li>{{ $user->name }}</li>
@empty
    <p>没有用户</p>
@endforelse

@while ($bool)
    <p>死循环了。</p>
@endwhile
<br />

<!--当使用循环时，你也可以结束循环或跳过当前迭代-->
@foreach ($array as $a)
    @if ($a === [])
        @continue
    @endif

    <li>{{ (string) $a }}</li>

    @if ($a === 1)
        @break
    @endif
@endforeach
<br />

<!--你还可以使用一行代码包含指令声明的条件,效果和上面类似-->
@foreach ($array as $a)
    @continue($a === [])

    <li>{{ (string) $a }}</li>

    @break($a === 1)
@endforeach
<br />

<!--循环变量-->
@foreach ($users as $user)
    @if ($loop->first)
        这是第一个迭代。<br />
    @endif

    @if ($loop->last)
        这是最后一个迭代。<br />
    @endif
    用户ID: {{ $user->id }}<br />
    索引:{{ $loop->index }}<br />
    已迭代次数:{{ $loop->iteration }}<br />
    剩余迭代次数:{{ $loop->remaining }}<br />
    总数:{{ $loop->count }}<br />
    ------<br />
@endforeach
<br />

@foreach ($users as $user)
    @foreach ($array as $a)
        @if ($loop->parent->first)
            这是父循环的第一次迭代<br />
        @endif
        循环嵌套的级别:{{ $loop->depth }}<br />
        父循环嵌套的级别:{{ $loop->parent->depth }}<br />
    @endforeach
    循环嵌套的级别:{{ $loop->depth }}<br />
    ------<br />
@endforeach
<br />

@php
    //纯php代码
    echo date('Y-m-d H:i:s',time());
@endphp


