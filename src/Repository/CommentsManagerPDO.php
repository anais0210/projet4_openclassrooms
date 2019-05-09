<?php

namespace Model;

use Entity\Comment;

/**
 * Class CommentsManagerPDO
 * @package Model
 */
class CommentsManagerPDO extends CommentsManager
{
    /**
     * @param Comment $comment
     * @return mixed|void
     */
    protected function add(Comment $comment)
    {
        $q = $this->dao->prepare('INSERT INTO comments SET news = :news, auteur = :auteur, contenu = :contenu, date = NOW()');

        $q->bindValue(':news', $comment->news(), \PDO::PARAM_INT);
        $q->bindValue(':auteur', $comment->auteur());
        $q->bindValue(':contenu', $comment->contenu());

        $q->execute();

        $comment->setId($this->dao->lastInsertId());
    }

    /**
     * @param $id
     * @return mixed|void
     */
    public function delete($id)
    {
        $this->dao->exec('DELETE FROM comments WHERE id = ' . (int)$id);
    }

    public function deleteFromNews($news)
    {
        $this->dao->exec('DELETE FROM comments WHERE news = ' . (int)$news);
    }

    /**
     * @param $news
     * @return mixed
     * @throws \Exception
     */
    public function getListOf($news)
    {
        if (!ctype_digit($news)) {
            throw new \InvalidArgumentException('L\'identifiant de la news passé doit être un nombre entier valide');
        }

        $q = $this->dao->prepare('SELECT id, news, auteur, contenu, date FROM comments WHERE news = :news');
        $q->bindValue(':news', $news, \PDO::PARAM_INT);
        $q->execute();

        $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');

        $comments = $q->fetchAll();

        foreach ($comments as $comment) {
            $comment->setDate(new \DateTime($comment->date()));
        }

        return $comments;
    }

    /**
     * @param Comment $comment
     * @return mixed|void
     */
    protected function modify(Comment $comment)
    {
        $q = $this->dao->prepare('UPDATE comments SET auteur = :auteur, contenu = :contenu WHERE id = :id');

        $q->bindValue(':auteur', $comment->auteur());
        $q->bindValue(':contenu', $comment->contenu());
        $q->bindValue(':id', $comment->id(), \PDO::PARAM_INT);

        $q->execute();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function get($id)
    {
        $q = $this->dao->prepare('SELECT id, news, auteur, contenu FROM comments WHERE id = :id');
        $q->bindValue(':id', (int)$id, \PDO::PARAM_INT);
        $q->execute();

        $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');

        return $q->fetch();
    }
}