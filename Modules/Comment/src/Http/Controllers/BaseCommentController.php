<?php

namespace Comment\Http\Controllers;

use App\Http\Controllers\Controller;
use Comment\Repository\Contracts\CommentRepository;

class BaseCommentController extends Controller
{
    public $commentRepository;

    public function __construct()
    {
        $this->commentRepository = resolve(CommentRepository::class);
    }
}
