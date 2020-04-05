<?php
declare(strict_types=1);

namespace Tests\Unit\app\Http\UseCases\Note;

use App\Http\UseCases\Contracts\Note\StoreUseCaseInterface;
use App\Http\UseCases\Note\StoreUseCase;
use App\Repositories\Contracts\NoteRepositoryInterface;
use Mockery;
use Tests\Unit\TestCase;

/**
 * Class StoreUseCaseTest
 * @package Tests\Unit\app\Http\UseCases\Note
 */
final class StoreUseCaseTest extends TestCase
{
    /**
     * test instance of.
     *
     * @return void
     */
    public function testInstanceOf()
    {
        /** Mockery\Mock|NoteRepositoryInterface $repository */
        $repository = Mockery::mock(NoteRepositoryInterface::class);

        $useCase = new StoreUseCase($repository);

        $this->assertInstanceOf(StoreUseCaseInterface::class, $useCase);
    }

    public function testConstruct()
    {
        // TODO:
    }

    public function testInvoke()
    {
        // TODO:
    }
}
