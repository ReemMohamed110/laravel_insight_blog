<?php

namespace App\Models;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable=['content','post_id','parent_id','user_id'];
    
        public function user()
        {
            return $this->belongsTo(User::class);
        }
        public function post()
        {
            return $this->belongsTo(Post::class);
        }
        public function replies()
        {
            return $this->hasMany(Comment::class,'parent_id');
        }
    
}
