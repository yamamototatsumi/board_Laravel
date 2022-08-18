<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Article;

class ArticlePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }


        /**
     * ログインユーザーが特定ポストの更新が可能であるか
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Article  $article // 第二引数は紐づいているモデルのインスタンスでないといけない
     * @return bool
     */
    public function update(User $user, Article $article)
    {
        return $user->user_id === $article->user_id;
        
    }
}
