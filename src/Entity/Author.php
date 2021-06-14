<?php


namespace App\Entity;


use Parad0xeSimpleFramework\Core\Http\Entity\AbstractEntity;

class Author extends AbstractEntity
{
    public static ?string $TABLE = "authors";

    private ?int $id = null;
    private ?string $name = null;
    private ?string $email = null;
    private ?string $password = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return Author
     */
    public function setId(?int $id): Author
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return Author
     */
    public function setName(?string $name): Author
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     * @return Author
     */
    public function setEmail(?string $email): Author
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null $password
     * @return Author
     */
    public function setPassword(?string $password): Author
    {
        $this->password = $password;
        return $this;
    }
}
