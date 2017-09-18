<?php

namespace litemerafrukt\User;

/**
 * User class to store in session
 */
class User
{
    public $id;
    public $name;
    public $email;
    public $level;

    /**
     * User constructor.
     *
     * @param int $id
     * @param string $name
     * @param string $email
     * @param int $level
     */
    public function __construct($id, $name, $email, $level)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->level = $level;
    }

    /**
     * Get id
     *
     * @return int
     *
     * @SuppressWarnings(PHPMD.ShortMethodName)
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function email()
    {
        return $this->email;
    }

    /**
     * Check if user has level or higher (lower number is higher level)
     *
     * Admin is both user and admin.
     *
     * @param int
     *
     * @return bool
     */
    public function isLevel($level)
    {
        return $this->level <= $level;
    }

    /**
     * Create a new user from this user
     *
     * @param array $updatedFields - keys should be named id, name, email, level to update
     *
     * @return User
     */
    public function newFromThis($updatedFields)
    {
        $id = $this->id;
        $name = $this->name;
        $email = $this->email;
        $level = $this->level;

        \extract($updatedFields);

        return new User($id, $name, $email, $level);
    }
}
