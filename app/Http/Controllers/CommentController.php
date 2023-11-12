<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\News;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index(string $id, string $sort)
    {
        $comments = Comment::where('published', 1)
					->where('parent', 0)
					->where('news_id', $id)
					->orderBy('created_at', $sort)
					->get();
		
		foreach($comments as $comment)
		{
			$comment->name = $comment->user_id == 2 ? $comment->guest : $comment->user->name;
			$comment->answers = Comment::where('published', 1)->where('parent', $comment->id)->count();
		}
		
		return $comments;
    }
	
	public function answers(string $id)
    {
        $comments = Comment::where('published', 1)->where('parent', $id)->get();
		
		foreach($comments as $comment)
		{
			$comment->name = $comment->user_id == 2 ? $comment->guest : $comment->user->name;
		}
		
		return $comments;
    }
	
	public function store(Request $request)
    {
		$data['parent'] = $request->parent;
		$data['star'] = 5;
		$data['content'] = $request->comment;
		$data['news_id'] = $request->post_id;
		$data['user_id'] = Auth::user() ? Auth::user()->id : 2;
		$data['guest'] = Auth::user() ? '' : $request->name;
		$data['published'] = 0;
  
        $comment = Comment::create($data);
		return $comment;
    }
	
}
