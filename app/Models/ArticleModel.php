<?php

namespace App\Models;


use App\Http\Observers\ArticleObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\ArticleModel
 *
 * @property int $article_id 自增ID
 * @property string $title 标题
 * @property string $desc 内容
 * @mixin \Eloquent
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleModel newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ArticleModel onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleModel query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleModel whereArticleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleModel whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleModel whereDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleModel whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleModel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ArticleModel withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ArticleModel withoutTrashed()
 */
class ArticleModel extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'articles';
    protected $primaryKey = 'article_id';
    protected $guarded = [];
    /*protected $dispatchesEvents = [
        'creating' => ArticleObserver::class,
    ];*/
    protected static function boot()
    {
        ArticleModel::observe(ArticleObserver::class);
        parent::boot();
    }


}
