<?php

namespace App\Http\Controllers;

use App\Models\ArticleModel;
use App\Requests\Article\ArticleCreateRequest;
use App\Requests\Article\FilterRequest;
use Carbon\Carbon;
use \Illuminate\Contracts\View\Factory;
use \Illuminate\Contracts\View\View;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;

class ArticleController extends Controller {

    public function getAll(FilterRequest $request) {
        $data = $request->validated();
        $categories = ArticleModel::pluck('category')->toArray();
        $query = ArticleModel::query();
        if (isset($data['categories'])) {
            $query->whereIn('category', $data['categories']);
        }
        if (isset($data['title'])) {
            $query->where('title', 'LIKE', "%{$data['title']}%");
        }
        if (isset($data['start_date'])) {
            $start = Carbon::parse($data['start_date']);
            $query->whereDate('created_at', '>=', $start->format('Y-m-d'));
        }
        if (isset($data['end_date'])) {
            $end = Carbon::parse($data['end_date']);
            $query->whereDate('created_at', '<=', $end->format('Y-m-d'));
        }
        if ($request->ajax()) {
            return view('articles-table-template', ['articles' => $query->paginate(3)]);
        }

        return view('article-list', [
            'articles' => $query->paginate(3),
            'categories' => $categories,
        ]);
    }

    public function get(int $id) {
        $article = ArticleModel::find($id);
        return view('article-detail', [
            'article' => $article,
            'comments' => $article->comments,
        ]);
    }

    public function create(ArticleCreateRequest $request) {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'category' => 'required',
            'content' => 'required',
        ]);
        $article = new ArticleModel();
        $article->title = $request->all()['title'];
        $article->author_full_name = $request->all()['author'];
        $article->category = $request->all()['category'];
        $article->post_content = $request->all()['content'];
        $article->save();
        return redirect('/');
    }

}
