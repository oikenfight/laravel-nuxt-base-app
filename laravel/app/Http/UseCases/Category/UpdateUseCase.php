<?php
declare(strict_types=1);

namespace App\Http\UseCases\Category;

use App\Entities\Contracts\CategoryInterface;
use App\Http\UseCases\Contracts\Category\UpdateUseCaseInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;

/**
 * Class UpdateUseCase
 * @package App\Http\UseCases\Category
 */
final class UpdateUseCase implements UpdateUseCaseInterface
{
    /**
     * @var CategoryRepositoryInterface
     */
    private $repository;

    /**
     * UpdateUseCase constructor.
     * @param CategoryRepositoryInterface $repository
     */
    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $categoryId
     * @param array $categoryData
     *
     * @return CategoryInterface
     * @throws \App\Repositories\Exceptions\CategoryNotFoundException
     */
    public function __invoke(int $categoryId, array $categoryData): CategoryInterface
    {
        return $this->repository->update($categoryId, [
            'name' => array_get($categoryData, 'name'),
        ]);
    }
}
