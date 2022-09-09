<?php

namespace App\Controllers;

use App\Models\PostModel;

class PostController extends BaseController
{
    /**
     * @return void
     */
    public function viewPosts(): void
    {
        $this->extracted();
    }

    /**
     * @return bool
     */
    public function posts(): bool
    {
        $title = 'Posts';

        $this->set(compact('title'));
        return $this->view('post/list');
    }

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
            PostModel::created($_POST);
            $this->extracted();
        }

    }

    /**
     * @return void
     */
    public function extracted(): void
    {
        if(isset($_POST['visitor_name'])){
            $posts = PostModel::getPosts('id', 'DESC', ['id' => 0],
                'id, visitor_name, post, created_at', operator: '>', limit: 'LIMIT 1');
        } else {
            $posts = PostModel::getPosts('created_at', 'DESC', ['id' => 0],
                'id, visitor_name, post, created_at', operator: '>');
        }
        foreach ($posts as $index => $post) {
            $pattern = '/(\d+)-(\d+)-(\d+) (\d+):(\d+):(\d+)/i';
            $replacement = '$3.$2.$1   $4:$5';
            $posts[$index]['created_at'] = preg_replace($pattern, $replacement, $post['created_at']);
        }
        $response = [
            'status' => true,
            'posts' => $posts
        ];
        echo json_encode($response);
    }
    public function getFields(): array
    {
        $error_fields = [];

        if ($_POST['visitor_name'] === '') {
            $error_fields[] = 'visitor_name';
        }

        if ($_POST['post'] === '') {
            $error_fields[] = 'post';
        }

        return $error_fields;
    }
}
