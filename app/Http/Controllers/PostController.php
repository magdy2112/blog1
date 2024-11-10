<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Traits\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    use Response;

    public function index($lang = 'ar')
    {
        $posts = Post::where('language',  $lang)
            ->with('comments.replies')->paginate();

            if($posts){

            }

        return response()->json($posts);
    } //end function
    //********************************************************************************************************************** */
    public function show_allpost_to_user($id, $lang = 'ar')
    {

        $posts = Post::where([
            'user_id' => $id,
            'language' => $lang,
        ])->with('comments.replies')->paginate();


        if (!$posts) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        return response()->json($posts);
    } //end function
    //********************************************************************************************************************** */

    public function singlepost($id, $lang = 'ar')
    {

        $post = Post::where([
            'id' => $id,
            'language' => $lang,
        ])
            ->with('comments.replies')
            ->get();


        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        return response()->json($post);
    } //end function

    //********************************************************************************************************************** */

    public function createpost(Request $request){
       $post = $request->validate([
            'title' => 'required|string',
            'content' =>'required|string',
            'language' =>'required|in:ar,en',
            'user_id' =>'required|exists:users,id',
        ]);

        $post = Post::create($post);
        if($post){
            return $this->response(true,200,'post_created',$post);

        }else{
            return $this->response(false,500,'error_creating_post');
        }
    }//end function


    //********************************************************************************************************************** */

    public function update($id, Request $request){

        $post_update = $request->validate([
            'title' => 'string',
            'content' =>'string',
            'language' =>'in:ar,en',
            'user_id' =>'exists:users,id',
        ]);
        $post = Post::find($id);

        if(!$post){
            return $this->response(false,404,'post_not_found');
        }

        $post->update( $post_update);

        return $this->response(true,200,'post_updated', $post_update);

    } //end function

    //********************************************************************************************************************** */
    public function destroy($id){
        $post = Post::find($id);
        if(!$post){
            return $this->response(false,404,'post_not_found');
        }else{
            $post->delete();
        }
}
} //end class
