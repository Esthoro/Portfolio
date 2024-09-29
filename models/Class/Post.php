<?php

namespace App;

use App\DB;

class Post
{
    public int $id;
    public string $title;
    public string $chapo;
    public string $content;
    public int $authorId;
    public $createdAt;
    public $updatedAt;

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
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getChapo(): string
    {
        return $this->chapo;
    }

    /**
     * @param string $chapo
     */
    public function setChapo(string $chapo): void
    {
        $this->chapo = $chapo;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return int
     */
    public function getAuthorId(): int
    {
        return $this->authorId;
    }

    /**
     * @param int $authorId
     */
    public function setAuthorId(int $authorId): void
    {
        $this->authorId = $authorId;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt($updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function create() {
        $sql = 'INSERT INTO post (title, chapo, content, author_id)
                VALUES (:title, :chapo, :content, :author_id)';
        $params = array(
            ':title' => $this->title,
            ':chapo' => $this->chapo,
            ':content' => $this->content,
            ':author_id' => $this->authorId
        );

        if (!DB::exec($sql, $params)) {
            return false;
        }
        return true;
    }

    public function showById()
    {
        $sql = 'SELECT * FROM post
        WHERE id = :id';
        $params = array(':id' => $this->id);
        if ($result = DB::exec($sql, $params)) {
            return $result->fetchAll(\PDO::FETCH_OBJ);
        }
        return false;
    }

    public function update()
    {
        if ($this->showById()) {

            $sql = 'UPDATE post
        SET title = :title,
            chapo = :chapo,
            content = :content,
            updated_at = NOW()
        WHERE id = :id';
            $params = array(
                ':title' => $this->title,
                ':chapo' => $this->chapo,
                ':content' => $this->content,
                ':id' => $this->id
            );

            if (!DB::exec($sql, $params)) {
                return false;
            }
            return true;
        }
    }

    public function delete() {

        if ($this->showById()) {

            $sql = 'DELETE FROM post WHERE id = :id';
            $params = array(
                ':id' => $this->id
            );

            if (DB::exec($sql, $params)) {
                return true;
            }
        }
        return false;
    }

    public function showAuthorByPostId() {
        $sql = 'SELECT * FROM person
        LEFT JOIN post
        ON person.id = post.author_id
        WHERE post.id = :postId';
        $params = array(
            ':idPost' => $this->id
        );
        if ($result = DB::exec($sql, $params)) {
            return $result->fetchAll(\PDO::FETCH_OBJ)[0];
        }
        return false;
    }

    public function showSinglePost() {
        $sql = 'SELECT * FROM post
        WHERE id = :id';
        $params = array(
            ':id' => $this->id
        );
        if ($result = DB::exec($sql, $params)) {
            return $result->fetchAll(PDO::FETCH_OBJ)[0];
        }
        return false;
    }

    public function showLastPosts($postsNumber = 1) {
        $sql = 'SELECT * FROM post
        ORDER BY updated_at DESC
        LIMIT :postsNumber';
        $params = array(
            ':postsNumber' => $postsNumber
        );
        if ($result = DB::exec($sql, $params)) {
            return $result->fetchAll(PDO::FETCH_OBJ);
        }
        return false;
    }

    public function showAll() {
        $sql = 'SELECT * FROM post
            ORDER BY updated_at DESC';
        if ($result = DB::exec($sql)) {
            return $result->fetchAll(PDO::FETCH_OBJ);
        }
        return false;
    }

}