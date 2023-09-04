<?php

namespace Comment\Http\Controller;


use Comment\Facades\CommentResponderFacade;
use Comment\Http\Controllers\BaseCommentController;
use Comment\Http\Validator\CommentsValidator;
use Comment\Models\Comment;

class CommentController extends BaseCommentController
{

    public function index()
    {
        $comments = collect();
        $commentsListCount=0;

        if (request()->wantsJson()) {
            $comments = $this->commentRepository->index(request('searchterm'));
        }
        return CommentResponderFacade::list($comments,$commentsListCount);
    }


    public function store()
    {
        $data = request()->all();

        // Validate Request
        $validator = CommentsValidator::check($data);
        if ($validator->fails()) {
            return CommentResponderFacade::validationFailed($validator->messages()->toArray());
        }

        // set user_id
        $data['user_id'] = auth()->user()->id;

        $data['comment_number'] = auth()->user()->id;

        // Store
        $medicalCenter = $this->commentRepository->store($data);

        // Response
        return CommentResponderFacade::storedSuccessfully($medicalCenter);
    }

    public function update(Comment $comment)
    {
        $data = request()->all();

        // Validate Request
        $validator = CommentsValidator::check($data);
        if ($validator->fails()) {
            return CommentResponderFacade::validationFailed($validator->messages()->toArray());
        }

        // Update
        $this->commentRepository->update($comment,$data);

        // Response
        return CommentResponderFacade::updatedSuccessfully($comment);
    }


    public function destroy(Comment $comment)
    {
        //delete product
        $this->commentRepository->delete($comment);

        // Response
        return CommentResponderFacade::deletedSuccessfully($comment);
    }

}
