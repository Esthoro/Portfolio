<?php

namespace App;

use App\DB;
use PDO;

class Comment
{
    public int $id;

    public int $postId;
    public $datePublication;
    public string $author;
    public string $content;
    public int $statut;

    const STATUS = [
        0 => 'Invalid',
        1 => 'Valid'
    ];
    
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
     * @return int
     */
    public function getPostId(): int
    {
        return $this->postId;
    }

    /**
     * @param int $postId
     */
    public function setPostId(int $postId): void
    {
        $this->postId = $postId;
    }

    /**
     * @return mixed
     */
    public function getDatePublication()
    {
        return $this->datePublication;
    }

    /**
     * @param mixed $datePublication
     */
    public function setDatePublication($datePublication): void
    {
        $this->datePublication = $datePublication;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @param string $author
     */
    public function setAuthor(string $author): void
    {
        $this->author = $author;
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
    public function showByUser() {
        $sql = 'SELECT comment.*, post.title
            FROM comment
            LEFT JOIN post
            ON comment.post_id = post.id
            WHERE comment.author_id = :author';

        $params = array(':author' => $this->author);

        if ($result = DB::exec($sql, $params)) {
            return $result->fetchAll(\PDO::FETCH_OBJ);
        }
        return false;
    }

    public function showByPost() {
            $sql = 'SELECT * FROM comment
            WHERE post_id = :id
            AND statut = 1
            ORDER BY edited_at DESC';
            $params = array(
                ':id' => $this->postId
            );
            if ($result = DB::exec($sql, $params)) {
                return $result->fetchAll(PDO::FETCH_OBJ);
            }
        return false;
    }

    public function showAllInvalidComments() {
        $sql = 'SELECT comment.*, person.pseudo
        FROM comment
        LEFT JOIN person
        ON comment.author_id = person.id
        WHERE comment.statut = 0
        ORDER BY comment.edited_at DESC';
        if ($result = DB::exec($sql)) {
            return $result->fetchAll(PDO::FETCH_OBJ);
        }
        return false;
    }

    public function delete () {
        $sql = 'DELETE FROM comment WHERE id = :commentId';
        $params = [':commentId' => $this->id];

        if (!isAdmin()) {
            $sql .= ' AND author_id = :userId';
            $params[':userId'] = $this->author;
        }
        if (!DB::exec($sql, $params)) {
            return false;
        }
        return true;
    }

    public function valid () {
        $sql = 'UPDATE comment
        SET statut = :statut
        WHERE id = :id';
        $params = array (
            ':statut' => $this->statut,
            ':id' => $this->id
        );
        if (!DB::exec($sql, $params)) {
            return false;
        }
        return true;
    }

    public function create() {
        $sql = 'INSERT INTO comment (post_id, author_id, content, statut)
                VALUES (:postId, :authorId, :content, :statut)';
        $params = array(
            ':postId' => $this->postId,
            ':authorId' => $this->author,
            ':content' => $this->content,
            ':statut' => $this->statut
        );

        if (!DB::exec($sql, $params)) {
            return false;
        }
        return true;
    }
    
}
