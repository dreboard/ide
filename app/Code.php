<?php

namespace App\Core;

use App\Core\Database;
use PDO;

/**
 * Class Code
 * @package App\Core
 */
class Code
{
    /* @var Database */
    protected $db;

    /**
     * @var
     */
    protected $data;

    /**
     * @var
     */
    protected $codeSections = ['general', 'arrays', 'strings', 'oop', 'regex', 'command'];

    /**
     * Code constructor.
     */
    public function __construct()
    {
        $this->db = Database::instance();
    }


    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        $stmt = $this->db->prepare("SELECT * FROM code WHERE id = ?");
        $stmt->bindValue(1, $id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @return mixed
     */
    public function findAll(string $section):array
    {
        if (!is_null($section)) {
            if ($section == 'code') {
                $in  = str_repeat('?,', count($this->codeSections) - 1) . '?';
                $sql = "SELECT * FROM code WHERE code_section IN ($in)";
                $stm = $this->db->prepare($sql);
                $stm->execute($this->codeSections);
            }else {
                $stm = $this->db->prepare("SELECT * FROM code WHERE code_section=?");
                $stm->execute([$section]);
            }
        }

        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * @param string $code_title
     * @param string $code_block
     * @param string $code_section
     * @return mixed
     */
    public function insertCode(string $code_title, string $code_block, string $code_section)
    {

        $sql = 'INSERT INTO code(code_title,code_block,code_section,code_date) '
            . 'VALUES(:code_title,:code_block,:code_section,:code_date)';

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':code_title' => $code_title,
            ':code_block' => $code_block,
            ':code_section' => $code_section,
            ':code_date' => time(),
        ]);

        return $this->db->lastInsertId();
    }


    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id)
    {
        $sql = 'DELETE FROM code '
            . 'WHERE id = :id';

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->rowCount();
    }

    /**
     * @param string $name
     * @return array
     */
    public function search(string $name): array
    {
        $name = "%$name%";
        $stm = $this->db->prepare("SELECT * FROM code WHERE code_title LIKE :name");
        $stm->bindParam(':name', $name);
        $stm->execute();
        return $stm->fetch(PDO::FETCH_ASSOC);
    }
}