<?php
declare(strict_types=1);

namespace Tests\Unit\app\Http\UseCases\Category;

use App\Entities\Contracts\CategoryInterface;
use App\Http\UseCases\Contracts\Category\UpdateUseCaseInterface;
use App\Http\UseCases\Category\UpdateUseCase;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Mockery;
use Tests\Unit\TestCase;


/**
 * Class UpdateUseCaseTest
 *
 * @package Tests\Unit\app\Http\UseCases\Category
 */
final class UpdateUseCaseTest extends TestCase
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

        $useCase = new UpdateUseCase($repository);

        $this->assertInstanceOf(UpdateUseCaseInterface::class, $useCase);
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

        $useCase = new UpdateUseCase($repository);

        $repositoryRef = $this->getHiddenProperty($useCase, 'repository');

        $this->assertSame($repository, $repositoryRef->getValue($useCase));
    }

    /**
     * test __invoke method
     *
     * @return void
     * @throws \App\Repositories\Exceptions\CategoryNotFoundException
     */
    public function testInvoke()
    {
        /** @var Mockery\Mock|CategoryInterface $user */
        $category = Mockery::mock(CategoryInterface::class);
        $expected = $category;

        $categoryId = 100;
        $name = 'dummy category name';
        $categoryData = [
            'name' => $name,
        ];
        $updateData = [
            'name' => $name,
        ];

        /** @var Mockery\Mock|CategoryRepositoryInterface $repository */
        $repository = Mockery::mock(CategoryRepositoryInterface::class);
        $repository->shouldReceive('update')->once()->with($categoryId, $updateData)->andReturn($category);

        $useCase = new UpdateUseCase($repository);

        $this->assertSame($expected, $useCase($categoryId, $categoryData));
    }
}
