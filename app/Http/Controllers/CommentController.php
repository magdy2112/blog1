<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\Response;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    use Response;
    public function mycomments(request $request)
    {

        $data = $request->validate([
            'user_id' => 'integer|exists:users,id',
            'post_id' => 'integer|exists:posts,id'
        ]);



        $user = User::find(request()->input('user_id'))->first();



         $comments = $user->comments()->where([

        'user_id'=> request()->input('user_id'),
        'post_id'=>request()->input('post_id'),

         ])->with('replies')->get();

         return $comments;

         if( $comments){

            return $this->response(true,200,'ok',$comments);

         }else{

            return $this->response(false,404,'No comments found');
         }
    }
}
