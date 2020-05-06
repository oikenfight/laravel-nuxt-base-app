<?php
declare(strict_types=1);

namespace App\Http\UseCases\Category;

use App\Entities\Contracts\CategoryInterface;
use App\Http\UseCases\Contracts\Category\DeleteUseCaseInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Http\Request;

/**
 * Class DeleteUseCase
 * @package App\Http\UseCases\Category
 */
final class DeleteUseCase implements DeleteUseCaseInterface
{
    /**
     * @var CategoryRepositoryInterface
     */
    private $repository;

    /**
     * DeleteUseCase constructor.
     * @param CategoryRepositoryInterface $repository
     */
    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $categoryId
     * @param Request $request
     *
     * @return CategoryInterface
     * @throws \App\Repositories\Exceptions\CategoryNotFoundException
     */
    public function __invoke(int $categoryId): bool
    {
        return $this->repository->delete($categoryId);
    }
}
