<?php
/**
 * Created by PhpStorm.
 * User: lleevi
 * Date: 9.8.2017
 * Time: 20.54
 */

class Discussion extends BaseModel
{
    public $id, $title, $description;

    public function __construct($attributes)
    {
        parent::__construct($attributes);
    }

    public static function all()
    {
        $query = DB::connection()->prepare('SELECT * FROM discussion');
        $query->execute();
        $rows = $query->fetchAll();
        $discussions = array();

        foreach ($rows as $row) {
            $discussions[] = new Discussion(array(
                'id' => $row['id'],
                'title' => $row['title'],
                'description' => $row['description']
            ));
        }
        return $discussions;
    }

    public function getTopicCount()
    {
        return Topic::getTopicCountByDiscussion($this->id);
    }

    public function getPostCount()
    {
        return Post::getPostCountByDiscussion($this->id);
    }

    public function getLastPost()
    {
        return Post::getByDiscussionLastPost($this->id);
    }

    public function save()
    {
        $query = DB::connection()->prepare('INSERT INTO discussion(title, description) VALUES(:title, :description) RETURNING id');
        $query->execute(array('title' => $this->title, 'description' => $this->description));

        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public static function find($id)
    {
        $query = DB::connection()->prepare('SELECT * FROM discussion WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $discussion = new Discussion(array(
                'id' => $row['id'],
                'title' => $row['title'],
                'description' => $row['description']
            ));
            return $discussion;
        }
        return null;
    }

}