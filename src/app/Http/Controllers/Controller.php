<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\User;
use App\Models\Article;
use App\Models\Comment;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected Article $article;
    protected User $user;
    protected Comment $comment;

    public function __construct(User $user, Article $article, Comment $comment)
    {
      $this->user = $user;
      $this->article = $article;
      $this->comment = $comment;
    }
  
}
