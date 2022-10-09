<!doctype html>
<html lang="ru">
<div id="tab_page" name="tab_page">
    @if($errors ->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach()
            </ul>
        </div>
    @endif()
    <table class="table" name="table_list">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Title</th>
            <th scope="col">Created</th>
            <th scope="col">Category</th>
        </tr>
        </thead>
        <tbody>
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
</html>
