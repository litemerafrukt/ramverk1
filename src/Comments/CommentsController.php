<?php

namespace litemerafrukt\Comments;

use litemerafrukt\Comments\Comments;
use litemerafrukt\Comments\Comment;
use litemerafrukt\Gravatar\Gravatar;
use litemerafrukt\User\UserLevels;

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
     * Comments root page
     */
    public function index()
    {
        $comments = $this->comments->all();

        $comments = \array_map(function ($comment) {
            $comment->gravatar = new Gravatar($comment->authorEmail);
            return $comment;
        }, $comments);

        $user = $this->di->get('user');
        $user->isUser = $user->isLevel(UserLevels::USER);
        $user->isAdmin = $user->isLevel(UserLevels::ADMIN);

        $this->renderPage("comments/comments", "Kommentarer", \compact('comments', 'user'));
    }

    /**
     * Add a comment
     */
    public function new()
    {
        $this->guard();

        $subject = $this->di->get('request')->getPost("subject");
        // $author = $this->di->get('request')->getPost("author");
        // $authorEmail = $this->di->get('request')->getPost("authorEmail");
        $text = $this->di->get('request')->getPost("text");

        $user = $this->di->get('user');

        list($ok, $message) = $this->comments->add($subject, $user->id, $user->name, $user->email, $text);

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
        $this->guard($id);

        list($ok, $message) = $this->comments->delete($id);

        if ($ok) {
            $this->di->get('flash')->setFlash($message, "flash-info");
        } else {
            $this->di->get('flash')->setFlash($message, "flash-danger");
        }

        $this->di->get('tlz')->redirectBack();
    }

    /**
     * Show edit page for a comment
     */
    public function edit($id)
    {
        $this->guard($id);

        $comment = $this->comments->fetch($id);

        if ($comment === null) {
            $this->di->get('flash')->setFlash("Kommentar med id: $id hittades inte.", "flash-danger");
            $this->di->get('tlz')->redirectBack();
        }

        $this->renderPage("comments/edit", "{$comment->subject}", ["comment" => $comment]);
    }

    /**
     * Handle posting of an edited comment
     */
    public function editHandler($id)
    {
        $this->guard($id);

        $subject = $this->di->get('request')->getPost("subject");
        // $author = $this->di->get('request')->getPost("author");
        // $authorEmail = $this->di->get('request')->getPost("authorEmail");
        $text = $this->di->get('request')->getPost("text");


        list($ok, $message) = $this->comments->upsert($id, $subject, $text);

        if ($ok) {
            $this->di->get('flash')->setFlash($message, "flash-success");
        } else {
            $this->di->get('flash')->setFlash($message, "flash-danger");
        }

        $this->di->get('tlz')->redirectBack();
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

    /**
     * Guard comment handling
     *
     * @param int $commentId
     */
    private function guard($commentId = null)
    {
        $user = $this->di->get('user');

        if ($user->isLevel(UserLevels::ADMIN)) {
            return;
        }

        if ($user->isLevel(UserLevels::USER) && $commentId == null) {
            return;
        }

        $comment = $this->comments->fetch($commentId);

        if ($user->isLevel(UserLevels::USER) && ($comment->authorId == $user->id)) {
            return $commentId;
        }

        $this->di->get('flash')->setFlash('Spärrad!', 'flash-danger');
        $this->di->get('tlz')->redirect('');
    }
}
