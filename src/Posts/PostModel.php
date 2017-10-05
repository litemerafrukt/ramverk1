<?php

namespace litemerafrukt\Posts;

use \Anax\Database\ActiveRecordModel;

class PostModel extends ActiveRecordModel
{
    protected $tableName = "posts";

    public $id;
    public $subject;
    public $author;
    public $authorId;
    public $authorEmail;
    public $rawText;
    public $created;
    public $updated;

    public function new($subject, $authorId, $author, $authorEmail, $text)
    {
        $post = new PostModel();
        $post->subject = \trim($subject);
        $post->authorId = $authorId;
        $post->author = \trim($author);
        $post->authorEmail = \trim($authorEmail);
        $post->rawText = \trim($text);

        $post->setDb($this->db);

        return $post;
    }

    /**
     * Get text formatted with $formatter
     *
     * @param callable $formatter callback that get raw comment as input
     *
     * @return output of formatter callback
     */
    public function getText($formatter)
    {
        return $formatter($this->rawText);
    }

    /**
     * Get raw text
     *
     * @return string
     */
    public function getRawText()
    {
        return $this->rawText;
    }
}
