<?php

namespace litemerafrukt\Admin;

use litemerafrukt\User\UserLevels;

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

    /**
     * Set user with id to admin
     *
     * @param int
     * @param string
     * @param string
     *
     * @return array [bool, string]
     */
    public function makeAdmin($id)
    {
        $sql = "UPDATE r1_users SET userlevel=? WHERE id=?";
        $statement = $this->db->query($sql, [UserLevels::ADMIN, $id]);
        if ($statement->errorCode() !== '00000') {
            return [false, "Kunde inte gör anvädare med id=$id till administratör."];
        }
        return [true, "Användare nr: $id, har nu administratörsrättigheter."];
    }

    /**
     * Delete user with id
     *
     * @param int
     *
     * @return array [bool, string]
     */
    public function deleteUser($id)
    {
        $sql = "DELETE FROM r1_users WHERE id=?";
        $statement = $this->db->query($sql, [$id]);
        if ($statement->errorCode() !== '00000') {
            return [false, "Kunde inte ta bort användare med id=$id."];
        }
        return [true, "Användare med id: $id, har tagits bort."];
    }
}
