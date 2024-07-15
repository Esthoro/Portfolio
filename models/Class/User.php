<?php

namespace App;
class User extends Person
{
    public int $role = 1;
    public int $statut;

    /**
     * @return int
     */
    public function getStatut(): int
    {
        return $this->statut;
    }

    /**
     * @param int $statut
     */
    public function setStatut(int $statut): void
    {
        $this->statut = $statut;
    }
}