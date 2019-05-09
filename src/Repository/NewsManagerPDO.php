<?php

namespace Model;

use Entity\News;

class NewsManagerPDO extends NewsManager
{
    /**
     * @param News $news
     * @return mixed|void
     */
    protected function add(News $news)
    {
        $request = $this->dao->prepare('INSERT INTO news SET auteur = :auteur, titre = :titre, contenu = :contenu, dateAjout = NOW(), dateModif = NOW()');

        $request->bindValue(':titre', $news->titre());
        $request->bindValue(':auteur', $news->auteur());
        $request->bindValue(':contenu', $news->contenu());

        $request->execute();
    }

    /**
     * @return mixed
     */
    public function count()
    {
        return $this->dao->query('SELECT COUNT(*) FROM news')->fetchColumn();
    }

    /**
     * @param $id
     * @return mixed|void
     */
    public function delete($id)
    {
        $this->dao->exec('DELETE FROM news WHERE id = ' . (int)$id);
    }

    /**
     * @param int $debut
     * @param int $limite
     * @return mixed
     * @throws \Exception
     */
    public function getList($debut = -1, $limite = -1)
    {
        $sql = 'SELECT id, auteur, titre, contenu, dateAjout, dateModif FROM news ORDER BY id DESC';

        if ($debut != -1 || $limite != -1) {
            $sql .= ' LIMIT ' . (int)$limite . ' OFFSET ' . (int)$debut;
        }

        $request = $this->dao->query($sql);
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\News');

        $listeNews = $requete->fetchAll();

        foreach ($listeNews as $news) {
            $news->setDateAjout(new \DateTime($news->dateAjout()));
            $news->setDateModif(new \DateTime($news->dateModif()));
        }

        $request->closeCursor();

        return $listeNews;
    }

    /**
     * @param $id
     * @return mixed|null
     * @throws \Exception
     */
    public function getUnique($id)
    {
        $request = $this->dao->prepare('SELECT id, auteur, titre, contenu, dateAjout, dateModif FROM news WHERE id = :id');
        $request->bindValue(':id', (int)$id, \PDO::PARAM_INT);
        $request->execute();

        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\News');

        if ($news = $request->fetch()) {
            $news->setDateAjout(new \DateTime($news->dateAjout()));
            $news->setDateModif(new \DateTime($news->dateModif()));

            return $news;
        }

        return null;
    }

    /**
     * @param News $news
     * @return mixed|void
     */
    protected function modify(News $news)
    {
        $request = $this->dao->prepare('UPDATE news SET auteur = :auteur, titre = :titre, contenu = :contenu, dateModif = NOW() WHERE id = :id');

        $request->bindValue(':titre', $news->titre());
        $request->bindValue(':auteur', $news->auteur());
        $request->bindValue(':contenu', $news->contenu());
        $request->bindValue(':id', $news->id(), \PDO::PARAM_INT);

        $request->execute();
    }
}