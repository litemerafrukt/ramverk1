<?php

namespace litemerafrukt\Comments;

class Comment
{
    private $id;
    private $subject;
    private $author;
    private $authorId;
    private $authorEmail;
    private $rawText;

    public function __construct($id, $subject, $authorId, $author, $authorEmail, $text)
    {
        $this->id = $id;
        $this->subject = \trim($subject);
        $this->authorId = $authorId;
        $this->author = \trim($author);
        $this->authorEmail = \trim($authorEmail);
        $this->rawText = \trim($text);
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Get author id
     *
     * @return int
     */
    public function getAuthorId()
    {
        return $this->authorId;
    }

    /**
     * Get author email
     *
     * @return string
     */
    public function getAuthorEmail()
    {
        return $this->authorEmail;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
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

     /**
     * Create a new comment from this comment
     *
     * @param array $updatedFields - keys should be comment field names
     *
     * @return Comment
     */
    public function newFromThis($updatedFields)
    {
        $id = $this->id;
        $subject = $this->subject;
        $authorId = $this->authorId;
        $author = $this->author;
        $authorEmail = $this->authorEmail;
        $rawText = $this->rawText;

        \extract($updatedFields);

        return new Comment($id, $subject, $authorId, $author, $authorEmail, $rawText);
    }
}
