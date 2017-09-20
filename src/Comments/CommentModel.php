<?php

namespace litemerafrukt\Comments;

use \Anax\Database\ActiveRecordModel;

class CommentModel extends ActiveRecordModel
{
    protected $tableName = "comments";

    public $id;
    public $subject;
    public $author;
    public $authorId;
    public $authorEmail;
    public $rawText;

    public function new($subject, $authorId, $author, $authorEmail, $text)
    {
        $comment = new CommentModel();
        $comment->subject = \trim($subject);
        $comment->authorId = $authorId;
        $comment->author = \trim($author);
        $comment->authorEmail = \trim($authorEmail);
        $comment->rawText = \trim($text);

        $comment->setDb($this->db);

        return $comment;
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
