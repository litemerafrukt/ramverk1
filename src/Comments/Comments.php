<?php

namespace litemerafrukt\Comments;

class Comments
{
    private $storage;

    /**
     * @param CommentStorage $storage
     * @param callback $textFormatter
     */
    public function __construct(CommentStorageInterface $storage)
    {
        $this->storage = $storage;
    }

    /**
     * Add a comment
     *
     * @param string
     * @param int
     * @param string
     * @param string
     * @param string
     *
     * @return Comment
     */
    public function add($subject, $authorId, $author, $authorEmail, $text)
    {
        $id = $this->storage->getNextId();

        $comment = new Comment($id, $subject, $authorId, $author, $authorEmail, $text);

        list($valid, $message) = $this->validateComment($comment);

        if ($valid) {
            $this->storage->add($comment);
            return [true, "Kommentaren, \"{$comment->getSubject()}\", har postats."];
        } else {
            return [false, $message];
        }
    }

    /**
     * Update/replace a comment
     *
     * @param integer
     * @param string
     * @param string
     * @param string
     * @param string
     *
     * @return Comment
     */
    public function upsert($id, $subject, $text)
    {
        $originalComment = $this->storage->fetch($id);

        $newComment = $originalComment->newFromThis(['subject' => $subject, 'rawText' => $text]);

        list($valid, $message) = $this->validateComment($newComment);

        if ($valid) {
            $this->storage->upsert($newComment);
            return [true, "Kommentaren, \"{$newComment->getSubject()}\", har ändrats."];
        } else {
            return [false, $message];
        }
    }
    /**
     * All comments
     *
     * @return array
     */
    public function all()
    {
        return $this->storage->all();
    }

    /**
     * Delete a comment by id
     *
     * @param integer
     */
    public function delete($id)
    {
        return $this->storage->delete($id);
    }

    /**
     * Empty all comments
     */
    public function deleteAll()
    {
        $this->storage->deleteAll();
    }

    /**
     * Fetch comment by id
     *
     * @return Comment
     */
    public function fetch($commentId)
    {
        return $this->storage->fetch($commentId);
    }

    /**
     * Initialize
     */
    public function init()
    {
        $this->storage->init();
    }

    /**
     * Validate the comment
     *
     * @param Comment
     *
     * @return [bool, string]
     */
    private function validateComment($comment)
    {
        if (\strlen($comment->getSubject()) === 0) {
            return [false, "Kommentaren måste ha ett ämne."];
        }

        if (\strlen($comment->getAuthorEmail()) === 0) {
            return [false, "E-postadress måste anges."];
        }

        return [true, "Validering ok"];
    }
}
