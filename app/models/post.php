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

    public function save()
    {
        $query = DB::connection()->prepare('INSERT INTO post(account_id, topic_id, content, posted) VALUES(:account_id, :topic_id, :content, :posted) RETURNING id');
        $query->execute(array('account_id' => $this->account_id, 'topic_id' => $this->topic_id, 'content'=>$this->content, 'posted'=>$this->posted));

        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public static function find($id)
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