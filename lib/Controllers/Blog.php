<?php

namespace Controller;
use \Model\Posts as Post;

class Blog extends Base
{

    public function index()
    {
        error_log(print_r('INDEX',1));
        $this->app->render('index.php');
    }

    public function show($id)
    {

        error_log(print_r('SHOW',1));
        $data = $this->app->params();
        $data['Id'] = $id;

//        Post::update($id, ['Name' => 'a2sd', 'Text' => 'olo111lo']);
//        $post = Post::selectOne($data);
//        error_log(print_r($post,1));

        $this->app->render('post.php');
    }

    public function edit($id)
    {
        $data = $this->app->params();

        $this->app->render('admin.php');
    }

    public function postEdit($id)
    {
        error_log(print_r('ID OF EDITED POST = ' . $id,1));
        $data = $this->app->params();

        error_log(print_r('DATA OF EDITED POST = ' ,1));
        error_log(print_r($data,1));
        Post::update($id, $data);
        header("Location: /post/" . $id);
    }

}
