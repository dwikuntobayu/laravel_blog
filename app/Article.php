<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
  public static function valid() {
    return array(
      'title' => 'required|min:10|unique:articles,title'.($id ? ",$id" : ''),
      'content' => 'required|min:100|unique:articles,content'.($id ? ",$id" : '')
    );
  }
}
