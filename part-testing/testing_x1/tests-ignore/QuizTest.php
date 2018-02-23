<?php
namespace App\Tests\Itb;

use App\Itb\QuizManager;

class QuizTest extends \PHPUnit\Framework\TestCase
{
    public function testZeroTotalAttemptedWhenCreated()
    {
        // Arrange
        $qm = new QuizManager();
        $expectedResult = 0;
        
        // Act
        $result = $qm->getTotalQuestionsAttempted();
        
        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testZeroTotalCorrectWhenCreated()
    {
        // Arrange
        $qm = new QuizManager();
        $expectedResult = 0;
        
        // Act
        $result = $qm->getTotalQuestionsCorrect();
        
        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testZeroTotalWrongWhenCreated()
    {
        // Arrange
        $qm = new QuizManager();
        $expectedResult = 0;
        
        // Act
        $result = $qm->getTotalQuestionsWrong();
        
        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testTwoTotalAttemptedWhenOneCorrectOneWrong()
    {
        // Arrange
        $qm = new QuizManager();
        $expectedResult = 2;
        $qm->addOneToCorrectTotal();
        $qm->addOneToWrongTotal();

        // Act
        $result = $qm->getTotalQuestionsAttempted();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testTwoTotalAttemptedWhenTwoCorrectZeroWrong()
    {
        // Arrange
        $qm = new QuizManager();
        $expectedResult = 2;
        $qm->addOneToCorrectTotal();
        $qm->addOneToCorrectTotal();

        // Act
        $result = $qm->getTotalQuestionsAttempted();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testTwoTotalCorrectdWhenTwoCorrect()
    {
        // Arrange
        $qm = new QuizManager();
        $expectedResult = 2;
        $qm->addOneToCorrectTotal();
        $qm->addOneToCorrectTotal();

        // Act
        $result = $qm->getTotalQuestionsCorrect();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testZeroPercentageCorrectWhenCreated()
    {
        // Arrange
        $qm = new QuizManager();
        $expectedResult = 0;

        // Act
        $result = $qm->getPercentageQuestionsCorrect();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testFiftyPercentageCorrectWhenOneCorrectOneWrong()
    {
        // Arrange
            $qm = new QuizManager();
        $expectedResult = 50;
        $qm->addOneToCorrectTotal();
        $qm->addOneToWrongTotal();

        // Act
        $result = $qm->getPercentageQuestionsCorrect();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testOneHundredPercentageCorrectWhenOneCorrectZeroWrong()
    {
        // Arrange
            $qm = new QuizManager();
        $expectedResult = 100;
        $qm->addOneToCorrectTotal();

        // Act
        $result = $qm->getPercentageQuestionsCorrect();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testTwentyFivePercentageCorrectWhenOneCorrectThreeWrong()
    {
        // Arrange
        $qm = new QuizManager();
        $expectedResult = 25;
        $qm->addOneToCorrectTotal();
        $qm->addOneToWrongTotal();
        $qm->addOneToWrongTotal();
        $qm->addOneToWrongTotal();

        // Act
        $result = $qm->getPercentageQuestionsCorrect();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testPassPercentageFiftyWhenCreated()
    {
        // Arrange
        $qm = new QuizManager();
        $expectedResult = 50;

        // Act
        $result = $qm->getPassPercentage();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testSetGetPassPercentageToSeventyFive()
    {
        // Arrange
        $qm = new QuizManager();
        $expectedResult = 75;
        $qm->SetPassPercentage(75);

        // Act
        $result = $qm->getPassPercentage();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testPassPercentageLessThanOneNotRecordedZero()
    {
        // Arrange
        $qm = new QuizManager();
        $expectedResult = 10;
        $qm->SetPassPercentage(10);
        $qm->SetPassPercentage(0);

        // Act
        $result = $qm->getPassPercentage();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testPassPercentageLessThanOneNotRecordedMinusOne()
    {
        // Arrange
        $qm = new QuizManager();
        $expectedResult = 50;
        $qm->SetPassPercentage(-1);

        // Act
        $result = $qm->getPassPercentage();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testPassPercentageMoreThanOneHundredNotRecordedOneHundredAndOne()
    {
        // Arrange
        $qm = new QuizManager();
        $expectedResult = 50;
        $qm->SetPassPercentage(101);

        // Act
        $result = $qm->getPassPercentage();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testPassPercentageMoreThanOneHundredeNotRecordedTwoHundred()
    {
        // Arrange
        $qm = new QuizManager();
        $expectedResult = 10;
        $qm->SetPassPercentage(10);
        $qm->SetPassPercentage(200);

        // Act
        $result = $qm->getPassPercentage();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testFailedExameWhenCreated()
    {
        // Arrange
        $qm = new QuizManager();
        $expectedResult = false;

        // Act
        $result = $qm->hasPassed();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testPassedExamTwoCorrectAndOneWrongDefaultPassFifty()
    {
        // Arrange
        $qm = new QuizManager();
        $expectedResult = true;
        $qm->addOneToCorrectTotal();
        $qm->addOneToCorrectTotal();
        $qm->addOneToWrongTotal();

        // Act
        $result = $qm->hasPassed();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testFailedExamTwoWrongSetPassSeventy()
    {
        // Arrange
        $qm = new QuizManager();
        $expectedResult = false;
        $qm->addOneToCorrectTotal();
        $qm->addOneToCorrectTotal();
        $qm->addOneToWrongTotal();

        $qm->setPassPercentage(75);

        // Act
        $result = $qm->hasPassed();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testPassedExamTwoCorrectAndTwoWrongDefaultPassFifty()
    {
        // Arrange
        $qm = new QuizManager();
        $expectedResult = true;
        $qm->addOneToCorrectTotal();
        $qm->addOneToCorrectTotal();
        $qm->addOneToWrongTotal();

        // Act
        $result = $qm->hasPassed();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }
}
