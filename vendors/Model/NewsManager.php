<?php

namespace Model;

use App\Manager;
use Entity\News;

/**
 * Class NewsManager
 * @package Model
 */
abstract class NewsManager extends Manager
{
    /**
     * @param News $news
     * @return mixed
     */
    abstract protected function add(News $news);

    /**
     * @param News $news
     */
    public function save(News $news)
    {
        if ($news->isValid()) {
            $news->isNew() ? $this->add($news) : $this->modify($news);
        } else {
            throw new \RuntimeException('La news doit être validée pour être enregistrée');
        }
    }

    /**
     * @return mixed
     */
    abstract public function count();

    /**
     * @param $id
     * @return mixed
     */
    abstract public function delete($id);

    /**
     * @param int $debut
     * @param int $limite
     * @return mixed
     */
    abstract public function getList($debut = -1, $limite = -1);

    /**
     * @param $id
     * @return mixed
     */
    abstract public function getUnique($id);

    /**
     * @param News $news
     * @return mixed
     */
    abstract protected function modify(News $news);
}