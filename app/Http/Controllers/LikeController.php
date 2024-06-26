<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
  
    public function store(Request $request)
    {
        $like = new Like;

        $like->user_id = auth()->user()->id;
        $like->post_id = $request->input('post_id');
        $like->save();
    }

    public function destroy($id)
    {
        $like = Like::find($id);
        if (count(collect($like)) > 0 ){
            $like->delete();
        }
    }
}
