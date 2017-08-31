<?php


class Discussion extends BaseModel
{
    public $id, $title, $description;

    public function __construct($attributes)
    {
        parent::__construct($attributes);
        $this->validators = array('validate_title', 'validate_description');
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

    public function validate_title()
    {
        $errors = array();
        if ($this->title == '' || $this->title == null) {
            $errors[] = 'Otsikko ei voi olla tyhjä';
        }

        if (strlen($this->title) < 3) {
            $errors[] = 'Otsikon tullee olla vähintään kolme kirjainta';
        }

        if (strlen($this->title) > 64) {
            $errors[] = 'Otsikko saa olla korkeintaan 64 kirjainta';
        }
        return $errors;
    }

    public function validate_description()
    {
        $errors = array();
        if ($this->description == '' || $this->description == null) {
            $errors[] = 'Kuvaus ei voi olla tyhjä';
        }

        if (strlen($this->description) < 6) {
            $errors[] = 'Kuvauksen tulee olla vähintään kuusi kirjainta';
        }

        if (strlen($this->description) > 64) {
            $errors[] = 'Kuvaus saa olla korkeintaan 64 kirjainta';
        }
        return $errors;
    }
}