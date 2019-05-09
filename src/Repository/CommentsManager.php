<?php

namespace App\Config;

use App\Manager;
use Entity\Comment;

/**
 * Class CommentsManager
 * @package Model
 */
abstract class CommentsManager extends Manager
{
    /**
     * @param Comment $comment
     * @return mixed
     */
    abstract protected function add(Comment $comment);

    /**
     * @param $id
     * @return mixed
     */
    abstract public function delete($id);

    /**
     * @param $news
     * @return mixed
     */
    abstract public function deleteFromNews($news);

    /**
     * @param Comment $comment
     */
    public function save(Comment $comment)
    {
        if ($comment->isValid()) {
            $comment->isNew() ? $this->add($comment) : $this->modify($comment);
        } else {
            throw new \RuntimeException('Le commentaire doit être validé pour être enregistré');
        }
    }

    /**
     * @param $news
     * @return mixed
     */
    abstract public function getListOf($news);

    /**
     * @param Comment $comment
     * @return mixed
     */
    abstract protected function modify(Comment $comment);

    /**
     * @param $id
     * @return mixed
     */
    abstract public function get($id);
}