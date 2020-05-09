<?php
declare(strict_types=1);

namespace App\Http\UseCases\Contracts\Category;

use App\Entities\Contracts\CategoryInterface;
use App\Entities\Contracts\UserInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Http\Request;

/**
 * Interface StoreUseCaseInterface
 *
 * @package App\Http\UseCases\Contracts\Category
 */
interface StoreUseCaseInterface
{
    /**
     * StoreUseCaseInterface constructor.
     * @param CategoryRepositoryInterface $repository
     */
    public function __construct(CategoryRepositoryInterface $repository);

    /**
     * @param int $userId
     * @param array $categoryData
     *
     * @return CategoryInterface
     */
    public function __invoke(int $userId, array $categoryData=[]): CategoryInterface;
}
