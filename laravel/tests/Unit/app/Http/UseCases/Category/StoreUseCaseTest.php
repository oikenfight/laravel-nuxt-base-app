<?php
declare(strict_types=1);

namespace Tests\Unit\app\Http\UseCases\Category;

use App\Entities\Contracts\CategoryInterface;
use App\Entities\Contracts\UserInterface;
use App\Http\UseCases\Contracts\Category\StoreUseCaseInterface;
use App\Http\UseCases\Category\StoreUseCase;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Mockery;
use Tests\Unit\TestCase;


/**
 * Class StoreUseCaseTest
 *
 * @package Tests\Unit\app\Http\UseCases\Category
 */
final class StoreUseCaseTest extends TestCase
{
    /**
     * test instance of
     *
     * @return void
     */
    public function testInstanceOf()
    {
        /** @var Mockery\Mock|CategoryRepositoryInterface $repository */
        $repository = Mockery::mock(CategoryRepositoryInterface::class);

        $useCase = new StoreUseCase($repository);

        $this->assertInstanceOf(StoreUseCaseInterface::class, $useCase);
    }

    /**
     * test __construct
     *
     * @return void
     * @throws \ReflectionException
     */
    public function testConstruct()
    {
        /** @var Mockery\Mock|CategoryRepositoryInterface $repository */
        $repository = Mockery::mock(CategoryRepositoryInterface::class);

        $useCase = new StoreUseCase($repository);

        $repositoryRef = $this->getHiddenProperty($useCase, 'repository');

        $this->assertSame($repository, $repositoryRef->getValue($useCase));
    }

    /**
     * test __invoke method
     *
     * @return void
     */
    public function testInvoke()
    {
        /** @var Mockery\Mock|CategoryInterface $user */
        $category = Mockery::mock(CategoryInterface::class);
        $expected = $category;

        $userId = 100;
        $name = 'dummy category name';
        $categoryData = [
            'name' => $name
        ];
        $createData = [
            'user_id' => $userId,
            'name' => $name,
        ];

        /** @var Mockery\Mock|CategoryRepositoryInterface $repository */
        $repository = Mockery::mock(CategoryRepositoryInterface::class);
        $repository->shouldReceive('create')->once()->with($createData)->andReturn($category);

        $useCase = new StoreUseCase($repository);

        $this->assertSame($expected, $useCase($userId, $categoryData));
    }

    /**
     * test __invoke method with none input
     *
     * @return void
     */
    public function testInvokeWithCategoryDataIsNone()
    {
        /** @var Mockery\Mock|CategoryInterface $user */
        $category = Mockery::mock(CategoryInterface::class);
        $expected = $category;

        $userId = 100;
        $createData = [
            'user_id' => $userId,
            'name' => null,
        ];

        /** @var Mockery\Mock|UserInterface $user */
        $user = Mockery::mock(UserInterface::class);
        $user->id = $userId;

        /** @var Mockery\Mock|CategoryRepositoryInterface $repository */
        $repository = Mockery::mock(CategoryRepositoryInterface::class);
        $repository->shouldReceive('create')->once()->with($createData)->andReturn($category);

        $useCase = new StoreUseCase($repository);

        $this->assertSame($expected, $useCase($userId));
    }
}
