<?php

namespace App;
class Person
{
    const ROLES = [
        1 => 'User',
        2 => 'Admin'
    ];
    const STATUS = [
        0 => 'Disabled',
        1 => 'Enabled'
    ];
    public int $id;
    public string $firstname;
    public string $surname;
    public string $email;
    public string $pseudo;
    public int $role;
    public int $status;
    public string $password;

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }
    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     */
    public function setSurname(string $surname): void
    {
        $this->firstname = $surname;
    }
    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
    /**
     * @return string
     */
    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    /**
     * @param string $pseudo
     */
    public function setPseudo(string $pseudo): void
    {
        $this->pseudo = $pseudo;
    }

    /**
     * @return int
     */
    public function getRole(): int
    {
        return $this->role;
    }

    /**
     * @param int $role
     */
    public function setRole(int $role): void
    {
        $this->role = $role;
    }

    public function delete() {
        $sql = 'DELETE FROM person
       WHERE id = :id';
        $params = array(
            ':id' => $this->id
        );
        if (!DB::exec($sql, $params)) {
            return false;
        }
        return true;
    }

    public function updatePassword() {
        $sql = 'UPDATE person
        SET password = :password
        WHERE id = :id';
        $params = array(
            ':password' => $this->password,
            ':id' => $this->id
        );

        if (!DB::exec($sql, $params)) {
            return false;
        }
        return true;
    }

    public function updateData() {
        $sql = 'UPDATE person
        SET first_name = :firstName,
            surname = :surname,
            email = :email,
            pseudo = :pseudo
        WHERE id = :id';
        $params = array(
            ':firstName' => $this->firstname,
            ':surname' => $this->surname,
            ':email' => $this->email,
            ':pseudo' => $this->pseudo,
            ':id' => $this->id
        );

        if (!DB::exec($sql, $params)) {
            return false;
        }
        return true;
    }

    public function showAll() {
        $sql = 'SELECT * FROM person
            ORDER BY pseudo';
        if ($result = DB::exec($sql)) {
            return $result->fetchAll(PDO::FETCH_OBJ);
        }
        return false;
    }

    public function showById() {
        $sql = 'SELECT * FROM person
            WHERE id = :id';
        $params = array(
            ':id' => $this->id
        );
        if ($result = DB::exec($sql, $params)) {
            return $result->fetchAll(\PDO::FETCH_OBJ);
        }
        return false;
    }

    public function register() {
        $sql = 'INSERT INTO person (first_name, surname, email, pseudo, password, role, statut)
                VALUES (:first_name, :surname, :email, :pseudo, :password, :role, 0)';
        $params = array(
            ':firstName' => $this->firstname,
            ':surname' => $this->surname,
            ':email' => $this->email,
            ':pseudo' => $this->pseudo,
            ':password' => $this->password,
            ':role' => $this->role
        );

        if (!DB::exec($sql, $params)) {
            return false;
        }
        return true;
    }

    public function valid() {
        $sql = 'UPDATE person
        SET statut = :statut
        WHERE id = :id';
        $params = array(
            ':statut' => $this->status,
            ':id' => $this->id
        );

        if (!DB::exec($sql, $params)) {
            return false;
        }
        return true;
    }

    public function verify() {
        $sql = 'SELECT * FROM person
        WHERE pseudo = :pseudo
        AND statut = 1';

        $params = array(':pseudo' => $this->pseudo);

        if ($result = DB::exec($sql, $params)) {

            if ($result->rowCount() == 1) {

                $user = $result->fetch(\PDO::FETCH_OBJ);

                if (password_verify($this->password, $user->password)) {
                    return $user->id;
                }
            }
        }
        return false;
    }
}