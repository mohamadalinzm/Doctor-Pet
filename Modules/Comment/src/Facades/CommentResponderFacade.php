<?php

namespace Comment\Facades;

use Illuminate\Support\Facades\Facade;
use Comment\Responder\CommentApiResponder;
use Comment\Responder\CommentWebResponder;

class CommentResponderFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        $response = 'Web';

        if (request()->wantsJson()) {
            $response = 'Json';
        }

        return [
                'Json' => CommentApiResponder::class,
                'Web' => CommentWebResponder::class,
            ][$response] ?? CommentApiResponder::class;
    }
}
