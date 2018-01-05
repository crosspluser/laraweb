<!-- 继承布局:文件保存于 resources/views/child.blade.php(中文文档里路径也错了) -->

@extends('layouts.app')

@section('title', 'Page Title')

@section('sidebar')
    @parent<!--中文文档里漏了这一句-->
    <p>这将追加到主布局的侧边栏。</p>
@endsection

@section('content')
    <p>这是主体内容。</p>
@endsection