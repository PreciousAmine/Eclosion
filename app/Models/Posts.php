<?php

namespace App\Models;
use Conner\Likeable\Likeable;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
	use Likeable;
	protected $table = "posts";

	protected $fillable = ['title', 'slug', 'content', 'image', 'tags', 'user_id', 'category_id', 'allowed_comment', 'active'];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function comments()
	{
		return $this->hasMany(Comments::class, 'post_id');
	}

	public function category()
	{
		return $this->belongsTo(Categories::class, 'category_id', 'id');
	}
	// Likes
	//public function likes(){
		//return $this->hasMany('App\LikeDislike','post_id')->sum('like');
//}
// Dislikes
//public function dislikes(){
		//return $this->hasMany('App\LikeDislike','post_id')->sum('dislike');
//}

}
