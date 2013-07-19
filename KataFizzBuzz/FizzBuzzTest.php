<?php
include "FizzBuzz.php";

/**
 * FizzBuzz Kata tests
 */
class FizzBuzzTest extends PHPUnit_Framework_TestCase
{
    protected $fizzbuzz;

    public function setUp()
    {
        $this->fizzbuzz = new FizzBuzz();
    }

    public function testShouldReturnNumberIfNotMultipleOf3Or5()
    {
        $this->assertEquals(1, $this->fizzbuzz->convert(1));
    }

    public function testShouldConvertToFizzIfMultipleOf3()
    {
        $this->assertEquals('Fizz', $this->fizzbuzz->convert(3));
        $this->assertEquals('Fizz', $this->fizzbuzz->convert(9));
        $this->assertEquals('Fizz', $this->fizzbuzz->convert(18));
    }

    public function testShouldConvertToBuzzIfMultipleOf5()
    {
        $this->assertEquals('Buzz', $this->fizzbuzz->convert(5));
        $this->assertEquals('Buzz', $this->fizzbuzz->convert(20));
        $this->assertEquals('Buzz', $this->fizzbuzz->convert(35));
    }

    public function testShouldConvertToFizzBuzzIfMultipleOf3And5()
    {
        $this->assertEquals('FizzBuzz', $this->fizzbuzz->convert(15));
        $this->assertEquals('FizzBuzz', $this->fizzbuzz->convert(30));
        $this->assertEquals('FizzBuzz', $this->fizzbuzz->convert(45));
    }

    /**
     * @expectedException \LogicException
     */
    public function testThrowExceptionIfLessThanOne()
    {
        $this->fizzbuzz->convert(0);
    }

    /**
     * @expectedException \LogicException
     */
    public function testThrowExceptionIfGreaterThan100()
    {
        $this->fizzbuzz->convert(101);
    }
}