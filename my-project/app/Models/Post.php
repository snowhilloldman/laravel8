<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  use HasFactory;
  protected $title = 'Post';


  static $statusOptions = [
    'draft' => 'Darft',
    'closed' => 'Closed',
    'public' => 'public'
  ];

  static $postTypeOptions = [
    'org' => 'ORG-TK机构/卖家/服务商/MCN等',
    'news' => 'News-新闻资讯',
    'ugc' => 'UGC-用户信息发布'
  ];

  static $orgRoleOptions = array('MCN', '卖家', '服务商', '教培', '全部');


  public function category()
  {
    return $this->belongsTo(Category::class, 'id');
  }
}