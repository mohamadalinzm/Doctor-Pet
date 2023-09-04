<?php

namespace Comment\Responder;

use Comment\Http\Resources\CommentResource;
use Comment\Support\CommentMessage;
use Symfony\Component\HttpFoundation\Response;

use function response;

class CommentWebResponder
{
    public function list($comments)
    {
        return CommentResource::collection($comments);
    }

    public function adminMedicalCenterList($comments)
    {
        return CommentResource::collection($comments);
    }

    public function validationFailed(array $messages)
    {
        return response()->json([
            'status' => 'error',
            'message' => $messages,
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function storedSuccessfully($comment)
    {
        return response()->json([
            'status' => 'success',
            'message' => CommentMessage::$commentSavedSuccessfully,
            'data' => [
                'comment' => $comment,
            ],
        ]);

    }

    public function updatedSuccessfully($comment)
    {
        return response()->json([
            'status' => 'success',
            'message' => CommentMessage::$commentUpdatedSuccessfully,
            'data' => [
                'comment' => $comment,
            ],
        ]);

    }

    public function deletedSuccessfully($comment)
    {
        return response()->json([
            'status' => 'success',
            'message' => CommentMessage::$commentDeletedSuccessfully,
            'data' => [
                'comment' => $comment,
            ],
        ]);

    }
    public function restoredSuccessfully()
    {
        return response()->json([
            'status' => 'success',
            'message' => CommentMessage::$commentRestoredSuccessfully,
        ]);
    }

}
