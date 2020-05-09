<?php
declare(strict_types=1);

namespace App\Http\UseCases\Category;

use App\Entities\Contracts\CategoryInterface;
use App\Http\UseCases\Contracts\Category\FindUseCaseInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;

/**
 * Class FindUseCase
 *
 * @package App\Http\UseCases\Note
 */
class FindUseCase implements FindUseCaseInterface
{
    /**
     * @var CategoryRepositoryInterface
     */
    private $repository;

    /**
     * FindUseCase constructor.
     * @param CategoryRepositoryInterface $repository
     */
    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $categoryId
     * @return CategoryInterface
     * @throws \App\Repositories\Exceptions\CategoryNotFoundException
     */
    public function __invoke(int $categoryId): CategoryInterface
    {
        return $this->repository->find($categoryId);
    }
}
