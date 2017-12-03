<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2017/9/22
 * Time: 上午7:21
 */

namespace App\Repositories;


use App\Article;
use App\Content;
use App\Http\Requests\ArticleRequest;
use Auth;
use Illuminate\Support\Facades\DB;
use Purifier;

class ArticlesRepository
{
    public static function createArticle(ArticleRequest $request){
        // 文章概况保存
        $article = new Article();
        $article -> title = $request->get('title');
        $article -> thumbnail = $request->get('thumbnail');
        $article -> user_id = Auth::user()->id;
        $article -> publish = ($request -> get('publish') == 1);
        $article -> save();
        // 文章内容保存
        $content = new Content();
        $content -> markdown_content = Purifier::clean($request -> get('content'));
        $content -> content = Purifier::clean($request -> get('content'));
        $content -> article_id = $article -> id;
        $content -> save();
        // 文章 标签关联保存
        foreach ( $request->get('tags') as $tag){
            DB::insert('insert into article_tag (article_id, tag_id) values (?, ?)', [$article -> id, $tag]);
        }
        return $article->id;

    }



}