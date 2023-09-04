<?php

namespace Comment\Repository;

use Illuminate\Support\Str;
use Comment\Models\Comment;
use Comment\Repository\Contracts\CommentRepository;
use Morilog\Jalali\Jalalian;

class EloquentCommentRepository implements CommentRepository
{


    public function show(Comment $comment)
    {
        return $comment->select(['id','comment_number','type','title','message','status'])
            ->with(['user'])
            ->get()
            ->each(function ($item) {
                $item->date = Jalalian::forge(strtotime($item->created_at))->format('Y/m/d ');
            });
    }


    public function index($searchTerm = '', $active = null)
    {
        return Comment::select(['id','comment_number','type','title','status'])
            ->with(['user'])
            ->search($searchTerm)->get()
            ->each(function ($item) {
                $item->date = Jalalian::forge(strtotime($item->created_at))->format('Y/m/d ');
            });
    }


    public function delete(Comment $comment)
    {
        $comment->delete();
    }

    public function store($data,$entity)
    {

        $comment = new Comment;
        $comment->fill($data);

        return $entity->comments()->save($comment);
    }

    public function update(Comment $comment, $data)
    {

        return $comment->update($data);

    }

}
