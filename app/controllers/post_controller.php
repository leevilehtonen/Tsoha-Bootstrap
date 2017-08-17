<?php


class PostController extends BaseController
{

    public static function store($id)
    {
        $params = $_POST;
        $topic = Topic::find($id);
        $posts = Post::getByTopic($id);
        $attributes = array(
            'content' => $params['message'],
            'account_id' => self::get_user_logged_in()->id,
            'topic_id' => $id
        );
        $post = new Post($attributes);

        $errors = $post->errors();
        if (count($errors) == 0) {
            $post->save();
            Redirect::to('/discussion/' . $topic->discussion_id . '/topic/' . $id, array('message', 'Viesti lisätty'));
        } else {
            View::make('topics/posts.html', array('errors' => $errors, 'attributes' => $attributes, 'topic' => $topic, 'posts' => $posts));
        }
    }

    public static function edit($id)
    {
        $post = Post::find($id);
        $topic = Topic::find($post->topic_id);
        View::make('post/edit_post.html', array('post' => $post, 'topic' => $topic));
    }

    public static function update($id)
    {
        $params = $_POST;

        $attributes = array(
            'content' => $params['message']
        );

        $post = Post::find($id);
        $topic = Topic::find($post->topic_id);
        $post->content = $params['message'];
        $errors = $post->errors();

        if (count($errors) == 0) {
            $post->update();
            Redirect::to('/discussion/' . $topic->discussion_id . '/topic/' . $topic->id, array('message' => 'Muokkasit viestäsi onnistuneesti'));
        } else {
            View::make('post/edit_post.html', array('post' => $post, 'topic' => $topic, 'errors' => $errors));
        }

    }

    public static function destroy($id)
    {
        $post = Post::find($id);
        $topic = Topic::find($post->topic_id);
        $post->destroy();
        Redirect::to('/discussion/' . $topic->discussion_id . '/topic/' . $topic->id, array('message' => 'Viesti on poistettu'));
    }
}