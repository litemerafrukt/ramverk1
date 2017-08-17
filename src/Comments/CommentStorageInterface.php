<?php

namespace litemerafrukt\Comments;

interface CommentStorageInterface
{
    public function add(Comment $comment);
    public function all();
    public function delete($commentId);
    public function deleteAll();
    public function fetch($commentId);
    public function getNextId();
    public function init();
    public function upsert(Comment $comment);
}
