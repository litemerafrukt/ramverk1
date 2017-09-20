<?php

namespace litemerafrukt\Comments;

class Comments
{
    private $commentModel;

    /**
     * @param CommentStorage $storage
     * @param callback $textFormatter
     */
    public function __construct(CommentModel $commentModel)
    {
        $this->commentModel = $commentModel;
    }

    /**
     * All comments
     *
     * @return array
     */
    public function all()
    {
        return $this->commentModel->findAll();
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
        $comment = $this->commentModel->new($subject, $authorId, $author, $authorEmail, $text);
        $comment->save();
        return [true, "Kommentaren, \"{$comment->subject}\", har postats."];
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
        $comment = $this->commentModel->find("id", $id);

        $comment->subject = $subject;
        $comment->rawText = $text;

        $comment->save();

        return [true, "Kommentaren, \"{$comment->subject}\", har ändrats."];
    }

    /**
     * Delete a comment by id
     *
     * @param integer
     */
    public function delete($id)
    {
        $this->commentModel->delete($id);
        return [true, "Kommentaren borttagen."];
    }

    /**
     * Fetch comment by id
     *
     * @return Comment
     */
    public function fetch($commentId)
    {
        return $this->commentModel->find('id', $commentId);
    }
}
