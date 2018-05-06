<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FootballTeam
 *
 * @ORM\Table(name="football_team")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FootballTeamRepository")
 */
class FootballTeam
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     *
     * @ORM\ManyToOne(targetEntity="FootballLeague", inversedBy="teams")
     * @ORM\JoinColumn(name="league_id", referencedColumnName="id")
     *
     */
    private $strip;


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
     * Set name
     *
     * @param string $name
     *
     * @return FootballTeam
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set strip
     *
     * @param string $strip
     *
     * @return FootballTeam
     */
    public function setStrip($strip)
    {
        $this->strip = $strip;

        return $this;
    }

    /**
     * Get strip
     *
     * @return string
     */
    public function getStrip()
    {
        return $this->strip;
    }
}

