<?php

namespace Slotegrator\Core\Stores\Db;

use Doctrine\ORM\EntityRepository;
use Slotegrator\Core\Entities\User as IUser;
use Slotegrator\Core\Entities\User\NoneExisting;
use Slotegrator\Core\Entities\User\User;
use Slotegrator\Core\Stores\UsersStore as IUsersStore;

/**
 * class UsersStore
 */
class UsersStore extends EntityRepository implements IUsersStore
{
    public function findByLoginWithPass(string $login): IUser
    {
        $result = $this->getEntityManager()->createQueryBuilder()
                    ->select('u')
                    ->from(User::class, 'u')
                    ->where('u.login = :login')
                    ->setParameter('login', $login)
                    ->getQuery()
                    ->getArrayResult();
        if ( ! empty($result)) {
            return new User($result);
        }
        return new NoneExisting();
    }
}