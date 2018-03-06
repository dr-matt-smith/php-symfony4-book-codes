<?php
namespace App\Util\Test;


use App\Util\Calculator;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    public function testCanCreateObject()
    {
        // Arrange
        $calculator = new Calculator();

        // Act

        // Assert
        $this->assertNotNull($calculator);
    }

    public function testAddOneAndOne()
    {
        // Arrange
        $calculator = new Calculator();
        $num1 = 1;
        $num2 = 1;
        $expectedResult = 2;

        // Act
        $result = $calculator->add($num1, $num2);

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @dataProvider additionProvider
     */
    public function testAdditionsWithProvider($num1, $num2, $expectedResult)
    {
        // Arrange
        $calculator = new Calculator();

        // Act
        $result = $calculator->add($num1, $num2);

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function additionProvider()
    {
        return [
            [1, 1, 2],
            [2, 2, 4],
            [0, 1, 1],
        ];
    }

    public function testDivideOneAndOne()
    {
        // Arrange
        $calculator = new Calculator();
        $num1 = 1;
        $num2 = 1;
        $expectedResult = 1;

        // Act
        $result = $calculator->divide($num1, $num2);

        // Assert
        $this->assertEquals($expectedResult, $result);
    }


    public function testDivideOneAndZero()
    {
        // Arrange
        $calculator = new Calculator();
        $num1 = 1;
        $num2 = 0;

        // Expect exception - BEFORE you Act!
        $this->expectException(\InvalidArgumentException::class);

        // Act
        $result = $calculator->divide($num1, $num2);

        // Assert - FAIL - should not get here!
        $this->fail("Expected exception {\InvalidArgumentException::class} not thrown");
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testDivideOneAndZeroAnnotation()
    {
        // Arrange
        $calculator = new Calculator();
        $num1 = 1;
        $num2 = 0;

        // Act
        $result = $calculator->divide($num1, $num2);

        // Assert - FAIL - should not get here!
        $this->fail("Expected exception {\InvalidArgumentException::class} not thrown");
    }

}
