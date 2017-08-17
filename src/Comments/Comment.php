<?php

namespace litemerafrukt\Comments;

class Comment
{
    private $id;
    private $subject;
    private $author;
    private $authorEmail;
    private $rawText;

    public function __construct($id, $subject, $author, $authorEmail, $text)
    {
        $this->id = $id;
        $this->subject = \trim($subject);
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
}
