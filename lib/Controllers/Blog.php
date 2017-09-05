<?php

namespace Controller;
use \Model\Posts as Post;

class Blog extends Base
{

    public function index()
    {
        $posts = Post::index();

        foreach ($posts as $post) {
            echo "<pre>";
            print_r($post);
            echo "</pre>";
        }

        $this->app->render('index.php');
    }

    public function show($id)
    {
        $post = [];
        if (intval($id)) {
            $post = Post::findById($id);
        }

        $this->app->render('post.php', $post);
    }

    public function edit($id)
    {
        $post = [];
        if (intval($id)) {
            $post = Post::findById($id);
        }

        $this->app->render('admin.php', $post);
    }

    public function postEdit($id)
    {
        $data = $this->app->params();

        if (intval($id) && !empty($data)) {
            Post::update($id, $data);
            header("Location: /post/" . $id);
        } else {
            return false;
        }

    }

}
