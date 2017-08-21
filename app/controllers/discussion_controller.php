<?php
/**
 * Created by PhpStorm.
 * User: lleevi
 * Date: 9.8.2017
 * Time: 21.03
 */


class DiscussionController extends BaseController{

    public static function index(){
        $discussions = Discussion::all();
        View::make('discussion/index.html', array('discussions' => $discussions));
    }

    public static function show($id)
    {
        $discussion = Discussion::find($id);
        $topics = Topic::findByDiscussion($id);
        View::make('discussion/topics.html', array('discussion' => $discussion, 'topics' => $topics));
    }

    public static function store()
    {
        $discussions = Discussion::all();
        $params = $_POST;
        $attributes = array(
            'title' => $params['title'],
            'description' => $params['description']
        );
        $discussion = new Discussion($attributes);

        $errors = $discussion->errors();
        if (count($errors) == 0) {
            $discussion->save();
            Redirect::to('/discussion/' . $discussion->id, array('message', $discussion->title . ' -alue luotu'));
        } else {
            View::make('discussion/index.html', array('errors' => $errors, 'attributes' => $attributes, 'discussions' => $discussions));
        }

    }
}