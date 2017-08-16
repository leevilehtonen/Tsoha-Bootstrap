<?php
/**
 * Created by PhpStorm.
 * User: lleevi
 * Date: 9.8.2017
 * Time: 21.03
 */
require 'app/models/discussion.php';
require 'app/models/topic.php';

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
        $params = $_POST;

        $discussion = new Discussion(array(
            'title' => $params['title'],
            'description' => $params['description']
        ));
        $discussion->save();
        Redirect::to('/discussion/' . $discussion->id, array('message', $discussion->title . ' -alue luotu'));
    }
}