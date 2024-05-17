<?php

namespace App\Http\Controllers\Home;

use App\Models\Posts;
use App\Http\Controllers\Controller;

class TagsController extends Controller
{
	public function index($tag)
	{
		// Find all poems that have the same tag as $tag
		$posts = Posts::with(['user', 'comments', 'category'])->where('active', 1)->where('tags', 'LIKE', "%$tag%")->paginate(4);

		if ($posts->isEmpty()) {
			abort(404);
		}

		$selectedTag = $tag;

		$sidebarData = getSidebarData();

		return view('tags', compact('posts', 'selectedTag'), $sidebarData);
	}
}
