<?php
declare(strict_types=1);

namespace App\Http\UseCases\Contracts\Category;

use App\Repositories\Contracts\CategoryRepositoryInterface;

/**
 * Interface DeleteUseCaseInterface
 *
 * @package App\Http\UseCases\Contracts\Category
 */
interface DeleteUseCaseInterface
{
    /**
     * DeleteUseCaseInterface constructor.
     * @param CategoryRepositoryInterface $repository
     */
    public function __construct(CategoryRepositoryInterface $repository);

    /**
     * @param int $categoryId
     * @return bool
     */
    public function __invoke(int $categoryId): bool;
}
