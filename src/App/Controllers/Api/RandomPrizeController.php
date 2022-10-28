<?php

namespace Slotegrator\App\Controllers\Api;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Driver\SQLite3\Driver;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Exception;
use Slotegrator\Core\Entities\BonusPoint\RandomBonusPointsInRange;
use Slotegrator\Core\Entities\Gifts\GifsCollection;
use Slotegrator\Core\Entities\Gifts\GiftBonusPoints;
use Slotegrator\Core\Entities\Gifts\GiftMoney;
use Slotegrator\Core\Entities\Gifts\GiftPhysical;
use Slotegrator\Core\Entities\Money\Currency\USDollar;
use Slotegrator\Core\Entities\Money\Format\InMinorUnits;
use Slotegrator\Core\Entities\Money\RandomMoneyInRange;
use Slotegrator\Core\Entities\Physical\Car;
use Slotegrator\Core\Entities\Physical\House;
use Slotegrator\Core\Entities\Physical\PhysicalCollection;
use Slotegrator\Core\Entities\Physical\RandomPhysical;
use Slotegrator\Core\UseCases\RandomPrize\Request as RandomPrizeRequest;
use Slotegrator\Core\UseCases\RandomPrizeUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * class PresentController
 */
class RandomPrizeController
{
    protected RandomPrizeUseCase $case;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->case = new RandomPrizeUseCase(
            new GifsCollection([
                new GiftMoney(
                    new RandomMoneyInRange(
                        new InMinorUnits(10, new USDollar()),
                        new InMinorUnits(100, new USDollar())
                    )
                ),
                new GiftPhysical(
                    new RandomPhysical(
                        new PhysicalCollection([
                            new Car(),
                            new House()
                        ])
                    )
                ),
                new GiftBonusPoints(
                    new RandomBonusPointsInRange(100, 100 * 1000)
                )
            ]),
            new EntityManager(
                new Connection([], new Driver()),
                new Configuration()
            )
        );
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function get(Request $request):JsonResponse {
        $requestUseCase = new RandomPrizeRequest();
        $requestUseCase->user = $this->authedUser();
        $responseCase = $this->case->getRandom($requestUseCase);
        if ($responseCase->isValidateErrors()) {
            return new JsonResponse([
                'errors' => $responseCase->getValidationErrors()
            ], 421);
        }
        if ( ! $responseCase->isSuccess()) {
            return new JsonResponse([
                'error' => $responseCase->getErrorText()
            ], 405);
        }

        $gift = $responseCase->gift;
        return new JsonResponse([
            'data' => [
                'message' => "Вы выиграли приз: {$gift->name()} {$gift->value()}"
            ]
        ]);
    }
}