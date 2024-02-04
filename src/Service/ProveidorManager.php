<?php

namespace App\Service;

use App\Entity\Proveidor;
use App\Repository\ProveidorRepository;
use Doctrine\ORM\EntityManagerInterface;

class ProveidorManager 
{
    private $em;
    private $proveidorRepository;

    public function __construct(ProveidorRepository $proveidorRepository, EntityManagerInterface $em) {
        $this->em = $em;
        $this->proveidorRepository = $proveidorRepository;
    }

    public function crear(Proveidor $proveidor)
    {
        $this->em->persist($proveidor);
        $this->em->flush();
    }

    public function editar(Proveidor $proveidor)
    {
        $this->em->flush();
    }

    public function eliminar(Proveidor $proveidor)
    {
        $this->em->remove($proveidor);
        $this->em->flush();
    }
}