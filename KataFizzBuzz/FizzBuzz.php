<?php
/**
 * Implementation of FizzBuzz Kata
 */
class FizzBuzz
{
    public function convert($number)
    {
        if ($this->isOutOfRange($number)) {
            throw new \LogicException("Out of range");            
        }

        if ($this->isMultipleOf3($number) && $this->isMultipleOf5($number)) {
            return 'FizzBuzz';
        }

        if ($this->isMultipleOf3($number)) {
            return 'Fizz';
        }
        
        if ($this->isMultipleOf5($number)) {
            return 'Buzz';
        }
        
        return $number;
    }

    private function isMultipleOf3($number)
    {
        return (0 === $number % 3);
    }

    private function isMultipleOf5($number)
    {
        return (0 === $number % 5);
    }

    private function isOutOfRange($number)
    {
        return $number < 1 || $number > 100;
    }
}