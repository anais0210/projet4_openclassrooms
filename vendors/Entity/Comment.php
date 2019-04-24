<?php

namespace Entity;

use App\Entity;

/**
 * Class Comment
 * @package Entity
 */
class Comment extends Entity
{
    /**
     * @var $news
     * @var $auteur
     * @var $contenu
     * @var $date
     */
    protected $news,
        $auteur,
        $contenu,
        $date;

    const AUTEUR_INVALIDE = 1;
    const CONTENU_INVALIDE = 2;

    /**
     * @return bool
     */
    public function isValid()
    {
        return !(empty($this->auteur) || empty($this->contenu));
    }

    /**
     * @param $news
     */
    public function setNews($news)
    {
        $this->news = (int)$news;
    }

    /**
     * @param $auteur
     */
    public function setAuteur($auteur)
    {
        if (!is_string($auteur) || empty($auteur)) {
            $this->erreurs[] = self::AUTEUR_INVALIDE;
        }

        $this->auteur = $auteur;
    }

    /**
     * @param $contenu
     */
    public function setContenu($contenu)
    {
        if (!is_string($contenu) || empty($contenu)) {
            $this->erreurs[] = self::CONTENU_INVALIDE;
        }

        $this->contenu = $contenu;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function news()
    {
        return $this->news;
    }

    /**
     * @return mixed
     */
    public function auteur()
    {
        return $this->auteur;
    }

    /**
     * @return mixed
     */
    public function contenu()
    {
        return $this->contenu;
    }

    /**
     * @return mixed
     */
    public function date()
    {
        return $this->date;
    }
}