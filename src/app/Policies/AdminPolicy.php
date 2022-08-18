<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


                /**
     * ログインユーザーが特定コメントの更新が可能であるか
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Comment  $comment // 第二引数は紐づいているモデルのインスタンスでないといけない
     * @return bool
     */
    public function update(User $user)
    {
        return $user->is_admin === 1;
        
    }
}
