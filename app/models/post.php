<?php
/**
 * Created by PhpStorm.
 * User: lleevi
 * Date: 7.8.2017
 * Time: 16:20
 */

class Post extends BaseModel
{
    public $id, $account_id, $topic_id, $content, $posted;

    public function __construct($attributes)
    {
        parent::__construct($attributes);
    }

    public static function all()
    {
        $queqry = DB::connection()->prepare('SELECT * FROM post');
        $queqry->execute();
        $rows = $queqry->fetchAll();
        $posts = array();

        foreach ($rows as $row) {
            $posts[] = new Post(array(
                'id' => $row['id'],
                'account_id' => $row['account_id'],
                'topic_id' => $row['topic_id'],
                'content' => $row['content'],
                'posted' => $row['posted']
            ));
        }
        return $posts;
    }

    public static function save()
    {
        $query = DB::connection()->prepare('INSERT INTO Post(account_id, topic_id, content, posted) VALUES(:account_id, :topic_id, :content, :posted) RETURNING id');
        $query->execute(array('account_id' => $a));
        $row = $query->fetch();

        if ($row) {
            $post = new Post(array(
                'id' => $row['id'],
                'account_id' => $row['account_id'],
                'topic_id' => $row['topic_id'],
                'content' => $row['content'],
                'posted' => $row['posted'],
            ));
            return $post;
        }
        return null;

    }

    public function find($id)
    {
        $query = DB::connection()->prepare('SELECT * FROM post WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $post = new Post(array(
                'id' => $row['id'],
                'account_id' => $row['account_id'],
                'topic_id' => $row['topic_id'],
                'content' => $row['content'],
                'posted' => $row['posted'],
            ));
            return $post;
        }
        return null;
    }
}