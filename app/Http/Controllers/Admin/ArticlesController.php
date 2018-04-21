<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreArticlesRequest;
use App\Http\Requests\Admin\UpdateArticlesRequest;

class ArticlesController extends Controller
{
    /**
     * Display a listing of Article.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('article_access')) {
            return abort(401);
        }

        if (request('show_deleted') == 1) {
            if (! Gate::allows('article_delete')) {
                return abort(401);
            }
            $articles = Article::onlyTrashed()->get();
        } else {
            $articles = Article::all();
        }

        // You can change your locale language
//        App::setLocale('es');

        return view('admin.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating new Article.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('article_create')) {
            return abort(401);
        }
        return view('admin.articles.create');
    }

    /**
     * Store a newly created Article in storage.
     *
     * @param  \App\Http\Requests\StoreArticlesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticlesRequest $request)
    {
        if (! Gate::allows('article_create')) {
            return abort(401);
        }

        $article_data = [
            'en' => [
                'title'       => $request->input('en_title'),
                'description' => $request->input('en_description')
            ],
            'es' => [
                'title'       => $request->input('es_title'),
                'description' => $request->input('es_description')
            ],
        ];

        Article::create($article_data);

        return redirect()->route('admin.articles.index');
    }


    /**
     * Show the form for editing Article.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('article_edit')) {
            return abort(401);
        }
        $article = Article::findOrFail($id);

        return view('admin.articles.edit', compact('article'));
    }

    /**
     * Update Article in storage.
     *
     * @param  \App\Http\Requests\UpdateArticlesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArticlesRequest $request, $id)
    {
        if (! Gate::allows('article_edit')) {
            return abort(401);
        }

        $article_data = [
            'en' => [
                'title'       => $request->input('en_title'),
                'description' => $request->input('en_description')
            ],
            'es' => [
                'title'       => $request->input('es_title'),
                'description' => $request->input('es_description')
            ],
        ];

        $article = Article::findOrFail($id);
        $article->update($article_data);

        return redirect()->route('admin.articles.index');
    }


    /**
     * Display Article.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('article_view')) {
            return abort(401);
        }
        $article = Article::findOrFail($id);

        return view('admin.articles.show', compact('article'));
    }


    /**
     * Remove Article from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('article_delete')) {
            return abort(401);
        }
        $article = Article::findOrFail($id);
        $article->delete();

        return redirect()->route('admin.articles.index');
    }

    /**
     * Delete all selected Article at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('article_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Article::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Article from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('article_delete')) {
            return abort(401);
        }
        $article = Article::onlyTrashed()->findOrFail($id);
        $article->restore();

        return redirect()->route('admin.articles.index');
    }

    /**
     * Permanently delete Article from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('article_delete')) {
            return abort(401);
        }
        $article = Article::onlyTrashed()->findOrFail($id);
        $article->forceDelete();

        return redirect()->route('admin.articles.index');
    }
}
