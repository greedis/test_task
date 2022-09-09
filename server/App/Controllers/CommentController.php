<?php

namespace App\Controllers;

use App\Models\CommentModel;
use App\Models\PostModel;
use PDOException;

class CommentController extends BaseController
{
    /**
     * @return void
     */
    public function create(): void
    {
        $error_fields = $this->getFields();
        if (!empty($error_fields)){
            $response = [
                'status' => false,
                'message' => 'Fill in all the fields!'
            ];
            echo json_encode($response);
        } else{
            CommentModel::created($_POST);
            $this->extracted();
        }

    }

    public function extracted(): void
    {
        $comments = CommentModel::getComments('created_at', 'DESC', ['post_id' => $_POST['post_id']],
            'id, visitor_name, comment, created_at, post_id');
        if (!empty($comments)) {
            foreach ($comments as $index => $comment) {
                $pattern = '/(\d+)-(\d+)-(\d+) (\d+):(\d+):(\d+)/i';
                $replacement = '$3.$2.$1   $4:$5';
                $comments[$index]['created_at'] = preg_replace($pattern, $replacement, $comment['created_at']);
            }
            $response = [
                'status' => true,
                'comments' => $comments
            ];
        } else{
            $response = [
                'status' => false,
                'message' => 'There are no comments yet'
            ];
        }
        echo json_encode($response);
    }

    public function getFields(): array
    {
        $error_fields = [];

        if ($_POST['visitor_name'] === '') {
            $error_fields[] = 'visitor_name';
        }

        if ($_POST['comment'] === '') {
            $error_fields[] = 'comment';
        }

        return $error_fields;
    }
}
