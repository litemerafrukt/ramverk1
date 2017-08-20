<?php

namespace litemerafrukt\Controllers;

use litemerafrukt\Comments\Comments;
use litemerafrukt\Comments\Comment;
use litemerafrukt\Gravatar\Gravatar;

use Anax\DI\InjectionAwareInterface;
use Anax\DI\InjectionAwareTrait;

class CommentsController implements InjectionAwareInterface
{
    use InjectionAwareTrait;

    private $comments;
    private $commentFormatter;

    public function __construct(Comments $commentHandler, $commentFormatter)
    {
        $this->comments = $commentHandler;
        $this->commentFormatter = $commentFormatter;
    }

    /**
     * Setup comment system
     */
    public function prepare()
    {
        $this->comments->init();
    }

    /**
     * Delete all comments
     */
    public function deleteAll()
    {
        $this->comments->empty();

        $this->renderPage("comments/emptyconfirm", "Kommentarer nollställda");
    }

    /**
     * Comments root page
     */
    public function index()
    {
        $comments = $this->comments->all();

        $comments = \array_map(function ($comment) {
            $comment->gravatar = new Gravatar($comment->getAuthorEmail());
            return $comment;
        }, $comments);

        $this->renderPage("comments/comments", "Kommentarer", ["comments" => $comments]);
    }

    /**
     * Add a comment
     */
    public function new()
    {
        $subject = $this->di->get('request')->getPost("subject");
        $author = $this->di->get('request')->getPost("author");
        $authorEmail = $this->di->get('request')->getPost("authorEmail");
        $text = $this->di->get('request')->getPost("text");

        list($ok, $message) = $this->comments->add($subject, $author, $authorEmail, $text);

        if ($ok) {
            $this->di->get('flash')->setFlash($message, "flash-success");
        } else {
            $this->di->get('flash')->setFlash($message, "flash-danger");
        }

        $this->di->get('tlz')->redirectBack();
    }

    /**
     * Delete a comment
     */
    public function delete($id)
    {
        list($ok, $message) = $this->comments->delete($id);

        if ($ok) {
            $this->di->get('flash')->setFlash($message, "flash-info");
        } else {
            $this->di->get('flash')->setFlash($message, "flash-danger");
        }

        $this->app->redirectBack();
    }

    /**
     * Show edit page for a comment
     */
    public function edit($id)
    {
        $comment = $this->comments->fetch($id);

        if ($comment === null) {
            $this->di->get('flash')->setFlash("Kommentar med id: $id hittades inte.", "flash-danger");
            $this->app->redirectBack();
        }

        $this->renderPage("comments/edit", "{$comment->getSubject()}", ["comment" => $comment]);
    }

    /**
     * Handle posting of an edited comment
     */
    public function editHandler($id)
    {
        $subject = $this->di->get('request')->getPost("subject");
        $author = $this->di->get('request')->getPost("author");
        $authorEmail = $this->di->get('request')->getPost("authorEmail");
        $text = $this->di->get('request')->getPost("text");


        list($ok, $message) = $this->comments->upsert($id, $subject, $author, $authorEmail, $text);

        if ($ok) {
            $this->di->get('flash')->setFlash($message, "flash-success");
        } else {
            $this->di->get('flash')->setFlash($message, "flash-danger");
        }

        $this->app->redirectBack();
    }

    /**
     * Convenience function to render pages in comment system
     */
    private function renderPage($viewFile, $title, $data = [])
    {
        $data = \array_merge($data, ["formatter" => $this->commentFormatter]);

        $this->di->get('view')->add($viewFile, $data, "main");

        $this->di->get('pageRender')->renderPage(["title" => $title]);
    }
}
