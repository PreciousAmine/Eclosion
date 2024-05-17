<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Posts;
use App\Models\User;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Facades\Request;

class HomeController extends Controller
{
	public function index()
	{
		$posts = Posts::where('active', 1)
			->withCount(['comments as activeCommentsCount' => function ($query) {
				$query->where('active', 1);
			}])
			->with(['category', 'comments', 'user'])
			->orderBy('activeCommentsCount', 'desc')
			->latest()
			->paginate(4);

		$twitterCardImage = asset('images/blog-header.jpg');

		SEOTools::twitter()->setImage($twitterCardImage);

		$sidebarData = getSidebarData();

		return view('home', compact('posts'), $sidebarData);

	}

	public function users()
    {
        $users = User::get();
        return view('users', compact('users'));
    }


    /**
     * Show the application of itsolutionstuff.com.
     *
     * @return \Illuminate\Http\Response
     */
    public function user($id)
    {
        $user = User::find($id);
        return view('usersView', compact('user'));
    }


    /**
     * Show the application of itsolutionstuff.com.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajaxRequest(Request $request){


        $user = User::find($request->user_id);
        $response = auth()->user()->toggleFollow($user);


        return response()->json(['success'=>$response]);
    }



}
