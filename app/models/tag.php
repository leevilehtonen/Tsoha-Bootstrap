<?php

class Tag extends BaseModel
{

    public $id, $name;

    public function __construct($attributes)
    {
        parent::__construct($attributes);
        $this->validators = array();

    }

    public static function all()
    {
        $query = DB::connection()->prepare('SELECT * FROM tag');
        $query->execute();
        $rows = $query->fetchAll();
        $tags = array();

        foreach ($rows as $row) {
            $tags[] = new Tag(array(
                'id' => $row['id'],
                'name' => $row['name']
            ));
        }
    }

    public static function find($id)
    {
        $query = DB::connection()->prepare('SELECT * FROM tag WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));

        $row = $query->fetch();
        if ($row) {
            $tag = new Tag(array(
                'id' => $row['id'],
                'name' => $row['name']
            ));
            return $tag;
        } else {
            return null;
        }

    }

    public static function findByName($name)
    {
        $query = DB::connection()->prepare('SELECT * FROM tag WHERE name = :name LIMIT 1');
        $query->execute(array('name' => $name));

        $row = $query->fetch();
        if ($row) {
            $tag = new Tag(array(
                'id' => $row['id'],
                'name' => $row['name']
            ));
            return $tag;
        } else {
            return null;
        }

    }

    public static function findByTopic($id)
    {
        $query = DB::connection()->prepare('SELECT * FROM tag, topic_tag WHERE tag.id = topic_tag.tag_id AND topic_tag.topic_id = :id');
        $query->execute(array('id' => $id));
        $rows = $query->fetchAll();
        $tags = array();

        foreach ($rows as $row) {
            $tags[] = new Tag(array(
                'name' => $row['name']
            ));
        }
        return $tags;

    }

    public function save()
    {
        $query = DB::connection()->prepare('INSERT INTO tag(name) VALUES(:name) RETURNING id');
        $query->execute(array('name' => $this->name));
        $row = $query->fetch();
        $this->id = $row['id'];
    }
}