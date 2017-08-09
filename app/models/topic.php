<?php
/**
 * Created by PhpStorm.
 * User: lleevi
 * Date: 7.8.2017
 * Time: 16:20
 */
require 'app/models/post.php';

class Topic extends BaseModel
{
    public $id, $discussion_id, $title, $created;

    public function __construct($attributes)
    {
        parent::__construct($attributes);
    }

    public static function all()
    {
        $query = DB::connection()->prepare('SELECT * FROM topic');
        $query->execute();
        $rows = $query->fetchAll();
        $topics = array();

        foreach ($rows as $row) {
            $topics[] = new Topic(array(
                'id' => $row['id'],
                'discussion_id' => $row['discussion_id'],
                'title' => $row['title'],
                'created' => $row['created']
            ));
        }
        return $topics;
    }

    public static function find($id)
    {
        $query = DB::connection()->prepare('SELECT * FROM topic WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $topic = new Topic(array(
                'id' => $row['id'],
                'discussion_id' => $row['discussion_id'],
                'title' => $row['title'],
                'created' => $row['created']
            ));
            return $topic;
        }
        return null;
    }

    public static function findByDiscussion($id)
    {
        $query = DB::connection()->prepare('SELECT * FROM topic WHERE topic.discussion_id = :id ORDER BY created DESC');
        $query->execute(array('id' => $id));
        $rows = $query->fetchAll();
        $topics = array();

        foreach ($rows as $row) {
            $topics[] = new Topic(array(
                'id' => $row['id'],
                'discussion_id' => $row['discussion_id'],
                'title' => $row['title'],
                'created' => $row['created']
            ));
        }
        return $topics;
    }

    public static function getTopicCountByDiscussion($id)
    {
        $query = DB::connection()->prepare('SELECT COUNT(*) AS topics FROM topic WHERE topic.discussion_id = :id');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        if ($row) {
            return $row['topics'];
        }
        return null;
    }

    public function save()
    {
        $query = DB::connection()->prepare('INSERT INTO topic(discussion_id, title, created) VALUES(:discussion_id, :topic, :created) RETURNING id');
        $query->execute(array('discussion_id' => $this->discussion_id, 'title' => $this->title, 'created' => $this->created));

        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function getPostCount()
    {
        return Post::getPostCountByTopic($this->id);
    }

    public function getLast()
    {
        return Post::getByTopicLastPost($this->id);
    }

    public function getFirst()
    {
        return Post::getByTopicFirstPost($this->id);
    }
}