<?php

namespace litemerafrukt\Posts;

class Posts
{
    private $postModel;

    /**
     * @param CommentStorage $storage
     * @param callback $textFormatter
     */
    public function __construct(PostModel $postModel)
    {
        $this->postModel = $postModel;
    }

    /**
     * All comments
     *
     * @return array
     */
    public function all()
    {
        return $this->postModel->findAll();
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
     * @return array
     */
    public function add($subject, $authorId, $author, $authorEmail, $text)
    {
        $post = $this->postModel->new($subject, $authorId, $author, $authorEmail, $text);
        $post->save();
        return [true, "Inlägget, \"{$post->subject}\", har postats."];
    }

    /**
     * Update/replace a post
     *
     * @param integer
     * @param string
     * @param string
     * @param string
     * @param string
     *
     * @return array
     */
    public function upsert($id, $subject, $text)
    {
        $post = $this->postModel->find("id", $id);

        $post->subject = $subject;
        $post->rawText = $text;
        $post->updated = \date("Y-m-d H:i:s");

        $post->save();

        return [true, "Inlägget, \"{$post->subject}\", har ändrats."];
    }

    /**
     * Delete a post by id
     *
     * @param integer
     */
    public function delete($id)
    {
        $this->postModel->delete($id);
        return [true, "Inlägget borttaget."];
    }

    /**
     * Fetch post by id
     *
     * @return PostModel
     */
    public function fetch($id)
    {
        return $this->postModel->find('id', $id);
    }
}
