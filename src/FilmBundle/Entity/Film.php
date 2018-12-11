<?php

namespace FilmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Film
 *
 * @ORM\Table(name="film")
 * @ORM\Entity(repositoryClass="FilmBundle\Repository\FilmRepository")
 */
class Film
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=50)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="resumer", type="text")
     */
    private $resumer;

    /**
     * @var int
     *
     * @ORM\Column(name="nombre_spect", type="integer")
     */
    private $nombreSpect;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="duree", type="datetime")
     */
    private $duree;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heure_debut", type="datetime")
     */
    private $heureDebut;

    /**
     * @var string
     *
     * @ORM\Column(name="prix", type="string" ,length=20)
     */
    private $prix;

    /**
     * @ORM\ManyToOne("AppBundle\Entity\User")
     */
    private $users;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Film
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set resumer
     *
     * @param text $resumer
     *
     * @return Film
     */
    public function setResumer($resumer)
    {
        $this->resumer = $resumer;

        return $this;
    }

    /**
     * Get resumer
     *
     * @return text
     */
    public function getResumer()
    {
        return $this->resumer;
    }

    /**
     * Set nombreSpect
     *
     * @param integer $nombreSpect
     *
     * @return Film
     */
    public function setNombreSpect($nombreSpect)
    {
        $this->nombreSpect = $nombreSpect;

        return $this;
    }

    /**
     * Get nombreSpect
     *
     * @return int
     */
    public function getNombreSpect()
    {
        return $this->nombreSpect;
    }

    /**
     * Set duree
     *
     * @param \DateTime $duree
     *
     * @return Film
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * Get duree
     *
     * @return \DateTime
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * Set heureDebut
     *
     * @param \DateTime $heureDebut
     *
     * @return Film
     */
    public function setHeureDebut($heureDebut)
    {
        $this->heureDebut = $heureDebut;

        return $this;
    }

    /**
     * Get heureDebut
     *
     * @return \DateTime
     */
    public function getHeureDebut()
    {
        return $this->heureDebut;
    }

    /**
     * Set prix
     *
     * @param string $prix
     *
     * @return Film
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return string
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set users
     *
     * @param \AppBundle\Entity\User $users
     *
     * @return Film
     */
    public function setUsers(\AppBundle\Entity\User $users = null)
    {
        $this->users = $users;

        return $this;
    }

    /**
     * Get users
     *
     * @return \AppBundle\Entity\User
     */
    public function getUsers()
    {
        return $this->users;
    }
}
