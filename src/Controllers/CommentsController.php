<?php

namespace litemerafrukt\Controllers;

use litemerafrukt\Comments\Comments;
use litemerafrukt\Comments\Comment;
use litemerafrukt\Gravatar\Gravatar;

use \Anax\Common\AppInjectableInterface;
use \Anax\Common\AppInjectableTrait;

class CommentsController implements AppInjectableInterface
{
    use AppInjectableTrait;

    private $comments;
    private $commentFormatter;

    public function __construct(Comments $commentHandler, $commentFormatter)
    {
        $this->comments = $commentHandler;
        $this->commentFormatter = $commentFormatter;
    }

    public function prepare()
    {
        $this->comments->init();
    }

    public function empty()
    {
        $this->comments->empty();

        $this->renderPage("comments/emptyconfirm", "Kommentarer nollställda");
    }

    public function index()
    {
        $comments = $this->comments->all();

        $comments = \array_map(function ($comment) {
            $comment->gravatar = new Gravatar($comment->getAuthorEmail());
            return $comment;
        }, $comments);

        $this->renderPage("comments/comments", "Kommentarer", ["comments" => $comments]);
    }

    public function new()
    {
        $subject = $this->app->request->getPost("subject");
        $author = $this->app->request->getPost("author");
        $authorEmail = $this->app->request->getPost("authorEmail");
        $text = $this->app->request->getPost("text");


        list($ok, $message) = $this->comments->add($subject, $author, $authorEmail, $text);

        if ($ok) {
            $this->app->flash->setFlash($message, "flash-success");
        } else {
            $this->app->flash->setFlash($message, "flash-danger");
        }

        $this->app->redirectBack();
    }

    public function delete($id)
    {
        list($ok, $message) = $this->comments->delete($id);

        if ($ok) {
            $this->app->flash->setFlash($message, "flash-info");
        } else {
            $this->app->flash->setFlash($message, "flash-danger");
        }

        $this->app->redirectBack();
    }

    public function edit($id)
    {
        $comment = $this->comments->fetch($id);

        if ($comment === null) {
            $this->app->flash->setFlash("Kommentar med id: $id hittades inte.", "flash-danger");
            $this->app->redirectBack();
        }

        $this->renderPage("comments/edit", "{$comment->getSubject()}", ["comment" => $comment]);
    }

    public function editHandler($id)
    {
        $subject = $this->app->request->getPost("subject");
        $author = $this->app->request->getPost("author");
        $authorEmail = $this->app->request->getPost("authorEmail");
        $text = $this->app->request->getPost("text");


        list($ok, $message) = $this->comments->upsert($id, $subject, $author, $authorEmail, $text);

        if ($ok) {
            $this->app->flash->setFlash($message, "flash-success");
        } else {
            $this->app->flash->setFlash($message, "flash-danger");
        }

        $this->app->redirectBack();
    }

    private function renderPage($viewFile, $title, $data = [])
    {
        $data = \array_merge($data, ["formatter" => $this->commentFormatter]);

        $this->app->view->add($viewFile, $data, "main");

        $this->app->renderPage(["title" => $title]);
    }
}
