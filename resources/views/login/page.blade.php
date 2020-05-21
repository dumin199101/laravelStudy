<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
<br>
<div class="container">
    <div class="row">
        <form action="{{route('page')}}" method="get" class="form-horizontal" role="form">
            <div class="form-group">
                <label for="title" class="col-sm-2 control-label">标题:</label>
                <div class="col-sm-5">
                    <input type="text" name="title" id="title" class="form-control" value="">
                </div>
                <div class="col-sm-5">
                    <button type="submit" class="btn btn-primary">搜索结果</button>
                </div>
            </div>
        </form>
    </div>
    <div class="row">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>标题</th>
                <th>更新时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @forelse($data as $val)
                <tr>
                    <td>{{$val->article_id}}</td>
                    <td>{{$val->title}}</td>
                    <td>{{$val->updated_at}}</td>
                    <td>
                        <a href="#" class="btn btn-primary">修改</a>
                        <a href="#" class="btn btn-danger">删除</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">暂无数据</td>
                </tr>
            @endforelse

            </tbody>
        </table>
    </div>
    <div class="row">
        {{$data->appends(request()->except('page'))->links()}}
    </div>
</div>
<!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
<script src="https://cdn.jsdelivr.net/npm/jquery@1.12.4/dist/jquery.min.js"></script>
<!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
</body>
</html>