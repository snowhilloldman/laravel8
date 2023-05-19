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
}