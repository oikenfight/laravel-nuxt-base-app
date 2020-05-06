<?php
declare(strict_types=1);

namespace App\Http\UseCases\Category;

use App\Entities\Contracts\CategoryInterface;
use App\Http\UseCases\Contracts\Category\StoreUseCaseInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;

/**
 * Class StoreUseCase
 * @package App\Http\UseCases\Category
 */
final class StoreUseCase implements StoreUseCaseInterface
{
    /**
     * @var CategoryRepositoryInterface
     */
    private $repository;

    /**
     * StoreUseCase constructor.
     * @param CategoryRepositoryInterface $repository
     */
    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $userId
     * @param array $categoryData
     *
     * @return CategoryInterface
     */
    public function __invoke(int $userId, array $categoryData=[]): CategoryInterface
    {
        return $this->repository->create([
            'user_id' => $userId,
            'name' => array_get($categoryData, 'name'),
        ]);
    }
}
