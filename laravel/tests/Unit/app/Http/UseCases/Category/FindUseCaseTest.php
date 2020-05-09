<?php
declare(strict_types=1);

namespace Tests\Unit\app\Http\UseCases\Category;

use App\Entities\Contracts\CategoryInterface;
use App\Entities\Contracts\UserInterface;
use App\Http\UseCases\Contracts\Category\FindUseCaseInterface;
use App\Http\UseCases\Category\FindUseCase;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Mockery;
use Tests\Unit\TestCase;


/**
 * Class FindUseCaseTest
 *
 * @package Tests\Unit\app\Http\UseCases\Category
 */
final class FindUseCaseTest extends TestCase
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

        $useCase = new FindUseCase($repository);

        $this->assertInstanceOf(FindUseCaseInterface::class, $useCase);
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

        $useCase = new FindUseCase($repository);

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

        /** @var Mockery\Mock|CategoryRepositoryInterface $repository */
        $repository = Mockery::mock(CategoryRepositoryInterface::class);
        $repository->shouldReceive('find')->once()->with($categoryId)->andReturn($category);

        $useCase = new FindUseCase($repository);

        $this->assertSame($expected, $useCase($categoryId));
    }
}
