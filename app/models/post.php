<?php


class Post extends BaseModel
{
    public $id, $account_id, $topic_id, $content, $posted;

    public function __construct($attributes)
    {
        parent::__construct($attributes);
    }

    public static function all()
    {
        $query = DB::connection()->prepare('SELECT * FROM post');
        $query->execute();
        $rows = $query->fetchAll();
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

    public static function getByTopic($id)
    {
        $query = DB::connection()->prepare('SELECT * FROM post WHERE topic_id = :id ORDER BY posted ASC');
        $query->execute(array('id' => $id));
        $rows = $query->fetchAll();
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

    public static function getPostCountByDiscussion($id)
    {
        $query = DB::connection()->prepare('SELECT COUNT(*) AS posts FROM topic, post  WHERE topic.discussion_id = :id AND post.topic_id = topic.id');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        if ($row) {
            return $row['posts'];
        }
        return null;
    }

    public static function getPostCountByTopic($id)
    {
        $query = DB::connection()->prepare('SELECT COUNT(*) AS posts FROM post  WHERE post.topic_id = :id');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        if ($row) {
            return $row['posts'];
        }
        return null;
    }

    public static function getByTopicLastPost($id)
    {
        $query = DB::connection()->prepare('SELECT * FROM post WHERE topic_id = :id ORDER BY posted DESC LIMIT 1');
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

    public static function getByTopicFirstPost($id)
    {
        $query = DB::connection()->prepare('SELECT * FROM post WHERE topic_id = :id ORDER BY posted ASC LIMIT 1');
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

    public static function getByDiscussionLastPost($id)
    {
        $query = DB::connection()->prepare('SELECT * FROM post, topic WHERE post.topic_id = topic.id AND topic.discussion_id = :id  ORDER BY posted DESC LIMIT 1');
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