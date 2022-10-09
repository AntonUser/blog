<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Articles</title>
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


<div class="input-group">
    <div class="form-outline">
        <input type="search" id="search" name="search" class="form-control" placeholder="Search"/>
    </div>
</div>
<div>
    <select id="select" name="select">
        <option name="option" id="option">Not selected</option>
        @foreach(array_unique( array(...$categories)) as $category)
            <option name="option" id="option">{{$category}}</option>
        @endforeach()
    </select>
    <label for="start">Start date:
        <input type="date" id="start_date" name="start_date">
    </label>
    <label for="end">End date:
        <input type="date" id="end_date" name="end_date">
    </label>
</div>
<div id="tab_page" name="tab_page">
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Title</th>
            <th scope="col">Created</th>
            <th scope="col">Category</th>
        </tr>
        </thead>
        <tbody id="table" name="table">
        @foreach($articles as $article)
            <tr>
                <td><a href="/article/{{$article->id}}">{{$article->title}}</a></td>
                <td>{{$article->created_at->diffForHumans()}}</td>
                <td>{{$article->category}}</td>
            </tr>
        @endforeach()
        </tbody>
    </table>
    <div id="paginator" name="paginator">
        {{$articles->withQueryString()->render()}}
    </div>
</div>
<input type="hidden" name="page_on" id="page_on" value="{{ $articles->currentPage() }}">
<div>
    <h5>Add article</h5>
    <form action="/article/create" method="post" style="width: 50%">
        @csrf
        <div class="form-group">
            <label>Title</label>
            <input class="form-control" type="text" placeholder="Title" id="title" name="title">
        </div>
        <div class="form-group">
            <label>Author</label>
            <input class="form-control" type="text" placeholder="FirstName Lastname" id="author" name="author">
        </div>
        <div class="form-group">
            <label>Category</label>
            <input class="form-control" type="text" placeholder="Category" id="category" name="category">
        </div>
        <div class="form-group">
            <label>Content</label>
            <input class="form-control" type="text" placeholder="Please enter your post" id="content" name="content">
        </div>
        <button type="submit" class="btn btn-primary">Crete Article</button>
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('select').change(function () {
            changeDate()
        });
        $('#start_date, #end_date').change(function () {
            changeDate()
        });
        $('#search').keyup(function () {
            changeDate()
        })
    });

    function changeDate() {
        let search = $('#search').val();
        let startDate = $('#start_date').val()
        let endDate = $('#end_date').val()
        let categories = $('#select').val();
        if (categories === 'Not selected') {
            categories = undefined;
        }
        if (isNaN(new Date(startDate).getFullYear())) {
            startDate = undefined;
        }
        if (isNaN(new Date(endDate).getFullYear())) {
            endDate = undefined
        }
        if (search === '') {
            search = undefined;
        }

        $.ajax({
            url: `/`,
            method: 'GET',
            data: {
                page: $('#page_on').val(),
                categories: [categories],
                start_date: startDate,
                end_date: endDate,
                title: search
            },
            success: function (data) {
                $('#tab_page').empty().html(data);
                location.hash = $('#page_on').val()
            },
        })
    }
</script>
</body>
</html>
