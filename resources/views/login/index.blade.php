<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.bootcdn.net/ajax/libs/vue/2.6.11/vue.min.js"></script>
</head>
<body>
<div id="app">
    <h1>Hello World</h1>
    <h2>{{$data['id']}}</h2>
    <h2>{{$data['name']}}</h2>
    <h3>{!! $title !!}</h3>
    <h3>{{$age ?? '没有年龄'}}</h3>
    {{--vue代码混编--}}
    <h4>@{{title}}</h4>
    <h3>{{date("Y-m-d")}}</h3>
    @if($age<10)
        <h1>小于10</h1>
    @elseif($age>=10 && $age<20)
        <h1>大于10小于20</h1>
    @else
        <h1>大于20</h1>
    @endif
    @foreach($user as $v)
        <h1>{{$v['name']}}</h1>
    @endforeach
    @forelse($book as $v)
        <h1>{{$v['name']}}</h1>
    @empty
        <h1>没有数据</h1>
    @endforelse
</div>
<script>
    var app = new Vue({
        el: '#app',
        data: {
            title: 'Hello,Vue'
        }
    });
</script>
</body>
</html>