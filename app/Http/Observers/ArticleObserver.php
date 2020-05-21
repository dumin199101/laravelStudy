<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/5/21
 * Time: 14:34
 */

namespace App\Http\Observers;


use App\Models\ArticleModel;

class ArticleObserver
{
    public function creating(ArticleModel $article)
    {
        $article->ip = request()->ip();
    }

}