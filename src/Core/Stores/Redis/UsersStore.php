<?php

namespace Slotegrator\Core\Stores\Redis;

use Psr\Cache\InvalidArgumentException;
use Slotegrator\Core\Entities\User;
use Slotegrator\Core\Stores\UsersStore as IUsersStore;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

/**
 * class UsersStore
 */
class UsersStore implements IUsersStore
{
    private IUsersStore $store;
    private CacheInterface $cache;

    public function __construct(IUsersStore $store, CacheInterface $cache)
    {
        $this->store = $store;
        $this->cache = $cache;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function findByLoginWithPass(string $login): User
    {
        return $this->cache->get("findByLoginWithPass_$login", function (ItemInterface $item) use ($login) {
            $item->expiresAfter(60);
            return $this->store->findByLoginWithPass($login);
        });
    }
}