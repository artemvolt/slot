<?php

namespace Slotegrator\Core\Entities\User;

use Slotegrator\Core\Components\Hasher;
use Slotegrator\Core\Entities\Gifts\Gift;
use Slotegrator\Core\Entities\User as IUser;
use Slotegrator\Core\Entities\User\Password\HashedPassword;

/**
 * class User
 */
class User implements IUser
{
    protected string $password_hash;
    protected string $salt;
    /**
     * @var Gift[] $gifts
     */
    protected array $gifts;

    public function isExisting(): bool
    {
        return true;
    }

    /**
     * @param Password $pass
     * @return bool
     */
    public function isEqualPass(Password $pass):bool
    {
        return $this->password_hash
                ===
                (new HashedPassword(
                    $pass,
                    new Hasher('sha256', $this->salt)
                ))->value();
    }

    public function winGift(Gift $gift): void
    {
        $this->gifts[] = $gift;
    }
}