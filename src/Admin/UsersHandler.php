<?php

namespace litemerafrukt\Admin;

/**
 * Class for administrating users
 */
class UsersHandler
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Get all users
     *
     * @return Collection
     */
    public function all()
    {
        $sql = "SELECT * FROM r1_users";
        return $this->db->query2collection($sql);
    }

    /**
     * Get user with id
     *
     * @param int $id
     *
     * @return array
     */
    public function fetchUser($id)
    {
        $sql = "SELECT * FROM r1_users WHERE id=?";
        return $this->db->query2collection($sql, [$id])->first();
    }
}
