<?php
declare(strict_types=1);

namespace Tests\Unit\app\Entities;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mockery;
use Tests\Unit\TestCase;

/**
 * Class EntityTest
 *
 * @package Tests\Unit\app\Entities
 */
final class EntityTest extends TestCase
{
    /**
     * instance of
     *
     * @return void
     */
    public function testInstanceOf()
    {
        $entity = Mockery::mock(Entity::class);

        $this->assertInstanceOf(Model::class, $entity);
    }

//    /**
//     * use SoftDeletes trait.
//     *
//     * @return void
//     */
//    public function testUseSoftDeletesTrait()
//    {
//        // TODO: use trait test
//        $this->assertTrue(class_uses_trait(Entity::class, SoftDeletes::class));
//    }
}
