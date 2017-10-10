<?php
namespace litemerafrukt\Posts;

use litemerafrukt\Posts\Posts;
use litemerafrukt\Gravatar\Gravatar;
use litemerafrukt\User\UserLevels;

use litemerafrukt\Comments\Comments;
use litemerafrukt\Comments\CommentHandler;

use Anax\DI\InjectionAwareInterface;
use Anax\DI\InjectionAwareTrait;

class PostsController implements InjectionAwareInterface
{
    use InjectionAwareTrait;

    private $posts;
    private $formatter;

    public function __construct(Posts $postHandler, $formatter)
    {
        $this->posts = $postHandler;
        $this->formatter = $formatter;
    }

    /**
     * posts root page
     */
    public function index()
    {
        $posts = $this->posts->all();

        $user = $this->di->get('user');
        $user->isUser = $user->isLevel(UserLevels::USER);

        $this->renderPage("posts/posts", "Inlägg", \compact('posts', 'user'));
    }

    /**
     * Show a post
     *
     * @param int $postId
     */
    public function showPost($id)
    {
        $post = $this->posts->fetch($id);
        $post->gravatar = new Gravatar($post->authorEmail);

        $user = $this->di->get('user');
        $user->isUser = $user->isLevel(UserLevels::USER);
        $user->isAdmin = $user->isLevel(UserLevels::ADMIN);

        $comments = new Comments(new CommentHandler($this->di->get('olddb')));

        if ($this->di->request->getPost('new-comment-submitted', false) && $user) {
            $authorId = $user->id;
            $authorName = $user->name;
            $parentId = $this->di->request->getPost('parent-id', 0);
            $text = \trim($this->di->request->getPost('comment-text'));
            $comments->new($id, $parentId, $authorId, $authorName, $text);

            $this->di->get("response")->redirectSelf();
        } else if ($this->di->request->getPost('edit-comment-submitted', false) && $user) {
            $id = $this->di->request->getPost('comment-id', null);
            $text = \trim($this->di->request->getPost('comment-text', ''));
            $comments->update($id, $text, function ($comment) use ($user) {
                return $comment['id'] === $user->id;
            });

            $this->di->get("response")->redirectSelf();
        }

        $commentsHTML = $comments->getHtml($id, $user->isUser, $user->isAdmin, $user->name, $user->id);

        $this->renderPage("posts/post", $post->subject, \compact('post', 'user', 'commentsHTML'));
    }

    /**
     * Add a post
     */
    public function new()
    {
        $this->guard();

        $subject = $this->di->get('request')->getPost("subject");

        $text = $this->di->get('request')->getPost("text");

        $user = $this->di->get('user');

        list($ok, $message) = $this->posts->add($subject, $user->id, $user->name, $user->email, $text);

        if ($ok) {
            $this->di->get('flash')->setFlash($message, "flash-success");
        } else {
            $this->di->get('flash')->setFlash($message, "flash-danger");
        }

        $this->di->get('tlz')->redirectBack();
    }

    /**
     * Delete a post
     */
    public function delete($id)
    {
        $this->guard($id);

        list($ok, $message) = $this->posts->delete($id);

        if ($ok) {
            $this->di->get('flash')->setFlash($message, "flash-info");
        } else {
            $this->di->get('flash')->setFlash($message, "flash-danger");
        }

        $comments = new Comments(new CommentHandler($this->di->get('olddb')));
        $comments->deleteComments($id);

        $this->di->get('tlz')->redirect("posts");
    }

    /**
     * Show edit page for a post
     */
    public function edit($id)
    {
        $this->guard($id);

        $post = $this->posts->fetch($id);

        if ($post === null) {
            $this->di->get('flash')->setFlash("Inlägget med id: $id hittades inte.", "flash-danger");
            $this->di->get('tlz')->redirectBack();
        }

        $this->renderPage("posts/edit", "{$post->subject}", ["post" => $post]);
    }

    /**
     * Handle posting of an edited post
     */
    public function editHandler($id)
    {
        $this->guard($id);

        $subject = $this->di->get('request')->getPost("subject");
        // $author = $this->di->get('request')->getPost("author");
        // $authorEmail = $this->di->get('request')->getPost("authorEmail");
        $text = $this->di->get('request')->getPost("text");


        list($ok, $message) = $this->posts->upsert($id, $subject, $text);

        if ($ok) {
            $this->di->get('flash')->setFlash($message, "flash-success");
        } else {
            $this->di->get('flash')->setFlash($message, "flash-danger");
        }

        $this->di->get('tlz')->redirect("posts/show/$id");
    }

    /**
     * Convenience function to render pages in comment system
     */
    private function renderPage($viewFile, $title, $data = [])
    {
        $data = \array_merge($data, ["formatter" => $this->formatter]);

        $this->di->get('view')->add($viewFile, $data, "main");

        $this->di->get('pageRender')->renderPage(["title" => $title]);
    }

    /**
     * Guard comment handling
     *
     * @param int $postId
     */
    private function guard($postId = null)
    {
        $user = $this->di->get('user');

        if ($user->isLevel(UserLevels::ADMIN)) {
            return;
        }

        if ($user->isLevel(UserLevels::USER) && $postId == null) {
            return;
        }

        $post = $this->posts->fetch($postId);

        if ($user->isLevel(UserLevels::USER) && ($post->authorId == $user->id())) {
            return $postId;
        }

        $this->di->get('flash')->setFlash('Spärrad!', 'flash-danger');
        $this->di->get('tlz')->redirect('');
    }
}
