<?php
declare(strict_types=1);

namespace App\Http\UseCases\Contracts\Category;

use App\Entities\Contracts\CategoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;

/**
 * Interface FindUseCaseInterface
 *
 * @package App\Http\UseCases\Contracts\Category
 */
interface FindUseCaseInterface
{
    /**
     * FindUseCaseInterface constructor.
     * @param CategoryRepositoryInterface $repository
     */
    public function __construct(CategoryRepositoryInterface $repository);

    /**
     * @param int $categoryId
     * @return CategoryInterface
     */
    public function __invoke(int $categoryId): CategoryInterface;
}
