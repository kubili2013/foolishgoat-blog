<?php

namespace App\Http\Controllers;

use App\Article;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;
use App\Repositories\ArticlesRepository;
use Illuminate\Support\Facades\Auth;
use Purifier;
use DB;

class ArticleController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except('show','articles');
        $this->middleware('role:blog_creator')->only(['create','update','trash']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return 'index';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 准备 Tags
        $tags = Tag::all();
        return view('article.create',['tags' => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        return redirect(route('article.show',['article'=>ArticlesRepository::createArticle($request)]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        $article->view_number = $article->view_number + 1;
        $article->save();
        $content = $article->content()->first();
        return view('article.view',['article' => $article, 'content'=> $content]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('article.edit',[
            'article' => $article,
            'tags' => Tag::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, Article $article)
    {
        if($article->user->id != Auth::user()->id){
            return redirect(route('article.show',['article'=>$article->id]));
        }
        // 文章概况保存
        $article -> title = $request->get('title');
        $article -> thumbnail = $request->get('thumbnail');
        $article -> publish = ($request -> get('publish') == 1);
        $article -> save();
        // 文章内容保存
        $content = $article->content;
        $content -> markdown_content = Purifier::clean($request -> get('content'));
        $content -> content = Purifier::clean($request -> get('content'));
        $content -> save();
        $article->tags()->detach();
        // 文章 标签关联保存
        foreach ( $request->get('tags') as $tag){
            DB::insert('insert into article_tag (article_id, tag_id) values (?, ?)', [$article -> id, $tag]);
        }
        return redirect(route('article.show',['article'=>$article->id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function trash($id)
    {
        $article = Article::find($id);
        if($article->user->id == Auth::user()->id){
            $article->delete();
        }
        return redirect(route('articles'));
    }


    public function articles(Request $request){
        if(empty($request->get('tag'))){
            $articles = Article::where(
                function ($query) use ($request) {
                    if(Auth::check()){
                        // $query->where('user_id',Auth::id());
                    }else{
                        $query->where('publish',true);
                    }
                    if(!empty($request->get('search'))){
                        $query->where('title','like',"%" . $request->get('search') . "%");
                    }
                }
            )->orderBy('updated_at', 'asc')->paginate(10);
        }else{
            $articles = Tag::find($request->get('tag'))
                ->articles()
                ->where(
                    function ($query) use ($request) {
                        if(Auth::check()){
                            // $query->where('user_id',Auth::id());
                        }else{
                            $query->where('publish',true);
                        }
                        if(!empty($request->get('search'))){
                            $query->where('title','like',"%" . $request->get('search') . "%");
                        }
                    }
                )->orderBy('updated_at', 'asc')
                ->paginate(2);
        }

        return view('article.list')
            ->with('tags',Tag::all())
            ->with('articles',$articles)
            ->with('class',array("danger","warning","success","default","primary","info"));
    }

    public function favorite(Request $request,$id){
        $article = Article::find($id);
        $user = Auth::user();
        $article->upusers()->attach($user->id);
        $article->upvote_number = $article->upvote_number + 1;
        $article->save();
        return ["id"=>$user->id,"avatar"=>$user->avatar];
    }

    public function detachFavorite(Request $request,$id){
        $article = Article::find($id);
        $user = Auth::user();
        $article->upusers()->detach($user->id);
        $article->upvote_number = $article->upvote_number - 1;
        $article->save();
        return ["id"=>$user->id,"avatar"=>$user->avatar];
    }
}
