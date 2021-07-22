<?php

namespace App\Entity;

use App\Repository\UploadRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass=UploadRepository::class)
 */
class Upload
{
    /**
     * @var User
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @ORM\OneToOne(targetEntity="User", cascade={"persist", "remove"})
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;



    public function getId(): User
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
