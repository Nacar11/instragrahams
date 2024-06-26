<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AllPostsCollection extends ResourceCollection
{
    public function toArray(Request $request)
    {
        return $this->collection->map(function ($post)
        {
            return [
                'id' => $post->id,
                'text' => $post->text,
                'file' => $post->file,
                'created_at' => $post->created_at->format(' M D Y'),
                'comments' => $post->comments->map(function ($comment){
                    return [
                        'id' => $comment->id,
                        'text' => $comment->text,
                        'user' => [
                            'id' => $comment->user->id,
                            'first_name' => $comment->user->first_name,
                            'last_name' => $comment->user->last_name,
                            'username' => $comment->user->username,
                            'file' => $comment->user->file
                        ],
                    ];
                }),
                'likes' => $post->likes->map(function ($like){
                    return [
                        'id' => $like->id,
                        'user_id' => $like->user_id,
                        'post_id' => $like->post_id
                    ];
                }),
                'user' => [
                    'id' => $post->user->id,
                    'first_name' => $post->user->first_name,
                    'last_name' => $post->user->last_name,
                    'username' => $post->user->username,
                    'file' => $post->user->file

                ],
            ];

        });
    }
}
