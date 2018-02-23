# php-symfony4-book-codes


1. create project
composer create-project symfony/skeleton testing02_unit


1. Install Symfony PHPUnit testing package

    ```bash
        composer req simple-phpunit
    ```

1. Add your test classes

    e.g.
    /tests/SimpleTest.php
        namespace: App\Test
        ensure they extend `\PHPUnit\Framework\TestCase`

    e.g.

       ```php
            <?php
            namespace App\Test;

            use PHPUnit\Framework\TestCase;

            class SimpleTest extends TestCase
            {
                public function testOnePlusOneEqualsTwo()
                {
                    // Arrange
                    $num1 = 1;
                    $num2 = 1;
                    $expectedResult = 2;

                    // Act
                    $result = $num1 + $num2;

                    // Assert
                    $this->assertEquals($expectedResult, $result);
                }
            }

       ```

1. Run Simple PHP Unit:

    ```bash
        $ php vendor/bin/simple-phpunit
    ```

    or (Windows BAT file?)

    ```bash
       $ vendor\bin\simple-phpunit
    ```

1. See the output:

```bash
    $ php vendor/bin/simple-phpunit
    PHPUnit 5.7.27 by Sebastian Bergmann and contributors.

    Testing Project Test Suite
    .                                                                   1 / 1 (100%)

    Time: 93 ms, Memory: 4.00MB

    OK (1 test, 1 assertion)

```

Dots are good ....





Nice links:

- [good PHP Unit tutorial](https://jtreminio.com/2013/03/unit-testing-tutorial-introduction-to-phpunit/)

    -- keep CRAP < 5 ...