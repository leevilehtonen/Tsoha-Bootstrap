<?php

require 'app/models/post.php';
require 'app/models/topic.php';

class TopicController extends BaseController{

    public static function show($id)
    {
        $topic = Topic::find($id);
        $posts = Post::getByTopic($id);
        View::make('topic/posts.html', array('topic' => $topic, 'posts' => $posts));
    }


}