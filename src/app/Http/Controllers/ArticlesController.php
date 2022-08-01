<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\ArticleModels;

class ArticlesController extends Controller
{
  public function index() {
    $total_count = $this->models->pageCount();
    $pages = ceil($total_count['count'] / MAX_VIEW);
    if(!isset($_GET['page_id'])){ 
        $now = 1;
    }else{
        $now = $_GET['page_id'];
    }
    $this->data = $this->models->PagerSystem($now, MAX_VIEW);
    require_once ( dirname(__FILE__) . $_ENV["ARTICLES_DIRECTRY"] . "article_list.php"); 
  }
}
