<?php

namespace Comment\Repository\Contracts;

use Comment\Models\Comment;

interface CommentRepository
{
    public function show(Comment $comment);

    public function index();

    public function delete(Comment $comment);

    public function store($data,$entity);

    public function update(Comment $comment, $data);

}
