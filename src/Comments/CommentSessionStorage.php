<?php

namespace litemerafrukt\Comments;

use litemerafrukt\Comments\CommentStorageInterface;
use litemerafrukt\Comments\Comment;

use Anax\Session\Session;

/**
 * Throw away class in prototyping for a comments/forum system
 * Hardcoded stuff in this throw away class out of simplicity, soon to
 * be changed for a class that do some actual storage
 */
class CommentSessionStorage implements CommentStorageInterface
{
    const KEY = "commentsessionstorage";

    private $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /**
     * Fetch all comments
     */
    public function all()
    {
        return $this->session->get(self::KEY, []);
    }

    /**
     * Add a comment
     */
    public function add(Comment $comment)
    {
        $allComments = $this->all();

        $allComments[] = $comment;
        $this->session->set(self::KEY, $allComments);

        return $comment;
    }

    /**
     * Delete all comments
     */
    public function deleteAll()
    {
        $this->session->destroy();
    }

    /**
     * Fetch a comment by id
     */
    public function fetch($commentId)
    {
        $allComments = $this->all();

        foreach ($allComments as $comment) {
            if ($comment->getId() === $commentId) {
                return $comment;
            }
        }
        return null;
    }

    /**
     * Get next comment Id
     */
    public function getNextId()
    {
        $allComments = $this->all();

        $maxId = \array_reduce($allComments, function ($maxId, $comment) {
            $id = $comment->getId();
            return $maxId < $id ? $id : $maxId;
        }, 0);

        return $maxId + 1;
    }

    /**
     * Init storage
     */
    public function init()
    {
        // $this->session = new Session();
        // $this->session->name("commentprototypesessionstorage:taljpinneiskogen");
        // $this->session->start();

        // Mock some entries
        // foreach ($this->mockComments() as $comment) {
        //     $this->add($comment);
        // }
    }

    /**
     * Update or insert new comment
     *
     * @param Comment
     */
    public function upsert(Comment $comment)
    {
        $allComments = $this->all();

        $index = $this->findIndex($allComments, $comment->getId());

        if ($index !== null) {
            $allComments[$index] = $comment;
        } else {
            $allComments[] = $comment;
        }

        $this->session->set(self::KEY, $allComments);
    }

    /**
     * Delete comment with id
     *
     * @param integer
     *
     * @return [bool, string]
     */
    public function delete($commentId)
    {
        $allComments = $this->all();

        $index = $this->findIndex($allComments, $commentId);

        if ($index !== null) {
            $commentSubject = $allComments[$index]->getSubject();
            unset($allComments[$index]);
            $this->session->set(self::KEY, $allComments);

            return [true, "Kommentar, $commentSubject, borttagen."];
        } else {
            return [false, "Kommentaren hittades inte"];
        }
    }

    // private function mockComments()
    // {
    //     return [
    //         new Comment("litemerafrukt", "litemerafrukt@gmail.com", "Det går bra nu", "Kommentarssystemet kommer att bli nått under dagen. `Comments`-klassen är nog onödig..."),
    //         new Comment("litemerafrukt", "litemerafrukt@gmail.com", "Men lite långsamt", "Ligger en dag efter 'borde vara klart' tidsschemat."),
    //     ];
    // }

    /**
     * Find index for comment
     *
     * @param array     $allComments
     * @param integer   $id      id of comment
     *
     * @return integer|null the item
     */
    private function findIndex($allComments, $id)
    {
        foreach ($allComments as $index => $comment) {
            if ($comment->getId() === $id) {
                return $index;
            }
        }
        return null;
    }
}
