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
     * @throws \Throwable
     * @return void
     */
    public function tearDown() :void
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
     * @throws \ReflectionException
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
     * @throws \ReflectionException
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
     * @throws \ReflectionException
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
     * @throws \ReflectionException
     */
    protected function getHiddenMethod($object, $method)
    {
        $class = new ReflectionClass($object);

        $methodRef = $class->getMethod($method);
        $methodRef->setAccessible(true);

        return $methodRef;
    }
}
