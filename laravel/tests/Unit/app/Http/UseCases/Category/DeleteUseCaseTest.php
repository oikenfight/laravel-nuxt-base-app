<?php
declare(strict_types=1);

namespace Tests\Unit\app\Http\UseCases\Category;

use App\Http\UseCases\Contracts\Category\DeleteUseCaseInterface;
use App\Http\UseCases\Category\DeleteUseCase;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Mockery;
use Tests\Unit\TestCase;


/**
 * Class DeleteUseCaseTest
 *
 * @package Tests\Unit\app\Http\UseCases\Category
 */
final class DeleteUseCaseTest extends TestCase
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

        $useCase = new DeleteUseCase($repository);

        $this->assertInstanceOf(DeleteUseCaseInterface::class, $useCase);
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

        $useCase = new DeleteUseCase($repository);

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
        $expected = true;
        $categoryId = 100;

        /** @var Mockery\Mock|CategoryRepositoryInterface $repository */
        $repository = Mockery::mock(CategoryRepositoryInterface::class);
        $repository->shouldReceive('delete')->once()->with($categoryId)->andReturn(true);

        $useCase = new DeleteUseCase($repository);

        $this->assertSame($expected, $useCase($categoryId));
    }
}
