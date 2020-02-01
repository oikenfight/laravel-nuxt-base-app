<?php
declare(strict_types=1);

namespace Tests\Unit;

use Mockery;
use ReflectionClass;

/**
 * Class TestCase
 *
 * @package Tests\Unit
 */
abstract class TestCase extends \Tests\TestCase
{
    /**
     * tearDown
     */
    public function tearDown()
    {
        parent::tearDown();
        Mockery::close();
    }

    /** @noinspection PhpDocMissingThrowsInspection \ReflectionException が起きても、どのみちテストがコケるだけなのでここで無視してしまう */
    /**
     * @param $object
     *
     * @return ReflectionClass
     */
    protected function getReflectionClass($object)
    {
        $reflection = new ReflectionClass($object);
        return $reflection;
    }

    /** @noinspection PhpDocMissingThrowsInspection \ReflectionException が起きても、どのみちテストがコケるだけなのでここで無視してしまう */
    /**
     * Sets a protected|private property on a given object via reflection
     *
     * @param $object - instance in which protected value is being modified
     * @param $property - property on instance being modified
     * @param $value - new value of the property being modified
     *
     * @return void
     */
    protected function setHiddenProperty($object, $property, $value)
    {
        $reflection = new ReflectionClass($object);
        $reflectionProperty = $reflection->getProperty($property);
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($object, $value);
    }

    /** @noinspection PhpDocMissingThrowsInspection \ReflectionException が起きても、どのみちテストがコケるだけなのでここで無視してしまう */
    /**
     * @param string $object
     * @param $property
     *
     * @return \ReflectionProperty
     */
    protected function getHiddenProperty($object, $property)
    {
        $class = new ReflectionClass($object);

        $property = $class->getProperty($property);
        $property->setAccessible(true);

        return $property;
    }

    /** @noinspection PhpDocMissingThrowsInspection \ReflectionException が起きても、どのみちテストがコケるだけなのでここで無視してしまう */
    /**
     * @param $object
     * @param $method
     * @param $params
     *
     * @return mixed
     */
    protected function callHiddenMethod($object, $method, ...$params)
    {
        $reflection = new ReflectionClass($object);
        $method = $reflection->getMethod($method);
        $method->setAccessible(true);
        return $method->invoke($object, ...$params);
    }

    /** @noinspection PhpDocMissingThrowsInspection \ReflectionException が起きても、どのみちテストがコケるだけなのでここで無視してしまう */
    /**
     * @param $object
     * @param $method
     *
     * @return \ReflectionMethod
     */
    protected function getHiddenMethod($object, $method)
    {
        $class = new ReflectionClass($object);

        $methodRef = $class->getMethod($method);
        $methodRef->setAccessible(true);

        return $methodRef;
    }

    /**
     * app() を通して ServiceContainer 内のインスタンスを置き換える for singleton
     *
     * @param $abstract
     * @param $object
     */
    public function replaceServiceContainerInstanceForSingleton($abstract, $object)
    {
        app()->singleton($abstract, function () use ($object) {
            return $object;
        });
    }

    /**
     * freeze bcrypt() value.
     *
     * @param $fixedPassword
     *
     * @return void
     */
    protected function freezeBcrypt($fixedPassword)
    {
        $bcryptHasher = Mockery::mock(\Illuminate\Hashing\BcryptHasher::class);
        $bcryptHasher->shouldReceive('make')->andReturn($fixedPassword);
        $hashManager = Mockery::mock(\Illuminate\Hashing\HashManager::class);
        $hashManager->shouldReceive('driver')->withArgs(['bcrypt'])->andReturn($bcryptHasher);
        app()->bind('hash', function () use ($hashManager) {
            return $hashManager;
        });
    }
}
