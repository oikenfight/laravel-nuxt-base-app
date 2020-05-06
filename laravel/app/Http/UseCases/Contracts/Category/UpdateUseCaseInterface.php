<?php
declare(strict_types=1);

namespace App\Http\UseCases\Contracts\Category;

use App\Entities\Contracts\CategoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;

/**
 * Interface UpdateUseCaseInterface
 *
 * @package App\Http\UseCases\Contracts\Category
 */
interface UpdateUseCaseInterface
{
    /**
     * UpdateUseCaseInterface constructor.
     * @param CategoryRepositoryInterface $repository
     */
    public function __construct(CategoryRepositoryInterface $repository);

    /**
     * @param int $categoryId
     * @param array $categoryData
     *
     * @return CategoryInterface
     */
    public function __invoke(int $categoryId, array $categoryData): CategoryInterface;
}
