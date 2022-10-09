<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <title>Document</title>
    <h1>{{$article->title}}</h1>
</head>
<body>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>
@if($errors ->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach()
        </ul>
    </div>
@endif()
<h4>{{$article->author_full_name}}</h4>
<div>
    <label>Category: {{$article->category}}</label>
</div>
<div>
    <label>Created: {{$article->created_at->format('d.m.Y')}}</label>
</div>
<div>
    <p>
        {{$article->post_content}}
    </p>
</div>
<a href="/">Back</a>

@foreach($comments as $comment)
    <div class="card p-3">
        <div class="d-flex justify-content-between align-items-center">
            <div class="user d-flex flex-row align-items-center">
                <span><small class="font-weight-bold text-primary">{{$comment->commentator_name}}</small> <small
                        class="font-weight-bold">{{$comment->comment_value}}</small></span>
            </div>
            <small>{{$comment->created_at->diffForHumans()}}</small>
        </div>
    </div>
@endforeach()

<form action="/comment/create" method="post">
    @csrf
    <input type="text" placeholder="New comment" id="comment_value" name="comment_value">
    <input type="text" placeholder="Ivan Ivanov" id="your_name" name="your_name">
    <input type="hidden" name="article_id" id="article_id" value="{{ $article->id }}">
    <button type="submit" class="btn btn-primary">Comment</button>
</form>
</body>
</html>
