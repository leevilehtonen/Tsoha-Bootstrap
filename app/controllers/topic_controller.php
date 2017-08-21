<?php


class TopicController extends BaseController{

    public static function show($id)
    {
        $topic = Topic::find($id);
        $posts = Post::getByTopic($id);
        View::make('topic/posts.html', array('topic' => $topic, 'posts' => $posts));
    }

    public static function store($id)
    {

        $discussion = Discussion::find($id);
        $topics = Topic::findByDiscussion($id);
        $params = $_POST;
        $attributes = array(
            'name' => $params['name'],
            'message' => $params['message'],
            'tags' => $params['tags']
        );
        $topicAttributes = array(
            'title' => $attributes['name'],
            'discussion_id' => $id
        );
        $postAttributes = array(
            'account_id' => self::get_user_logged_in()->id,
            'content' => $attributes['message'],
        );
        $topic = new Topic($topicAttributes);
        $post = new Post($postAttributes);

        $errors = $topic->errors();
        $errors = array_merge($errors, $post->errors());

        if (count($errors) == 0) {
            $topic->save();
            $post->topic_id = $topic->id;
            $post->save();

            $tagArray = explode(',', $attributes['tags']);
            $tagArray = array_map('strtolower', $tagArray);

            foreach ($tagArray as $tagStr) {
                $tag = Tag::findByName($tagStr);
                if ($tag == null) {
                    $tag = new Tag(array(
                        'name' => $tagStr
                    ));
                    $tag->save();
                }
                $topic->addTag($tag->id);

            }

            Redirect::to('/discussion/' . $discussion->id . '/topic/' . $topic->id, array('message', $discussion->title . ' -keskustelu luotu'));

        } else {
            View::make('discussion/topics.html', array('errors' => $errors, 'attributes' => $attributes, 'discussion' => $discussion, 'topics' => $topics));
        }

    }


}