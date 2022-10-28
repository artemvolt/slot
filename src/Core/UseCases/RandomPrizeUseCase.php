<?php

namespace Slotegrator\Core\UseCases;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Slotegrator\Core\Entities\Gifts\GifsCollection;
use Slotegrator\Core\UseCases\RandomPrize\Request;
use Slotegrator\Core\UseCases\RandomPrize\Response as PrizeResponse;

/**
 * class PrizeUseCase
 */
class RandomPrizeUseCase
{
    private GifsCollection $gifs;
    private EntityManager $manager;

    public function __construct(GifsCollection $gifs, EntityManager $manager) {
        $this->gifs = $gifs;
        $this->manager = $manager;
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function getRandom(Request $request): PrizeResponse
    {
        $validated = $request->validate();
        if ($validated->count() > 0) {
            return PrizeResponse::validateErrors($validated);
        }

        $gift = $this->gifs->rand();
        $request->user->winGift($gift);
        $this->manager->flush();

        $response = PrizeResponse::success();
        $response->gift = $gift;
        return $response;
    }
}