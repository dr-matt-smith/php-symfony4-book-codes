# php-symfony4-book-codes


1. Install Symfony PHPUnit testing pacakge

    ```bash
        composer req simple-phpunit
    ```

1. Add your test classes

    - ensure they extend `\PHPUnit\Framework\TestCase`

1. Install the BrowserKit & CSS selector:

    ```bash
        $ composer req --dev browser-kit css-selector
    ```

1. Ensure you have your MySQL Database runing

    - test DB ?

1. Run Simple PHP Unit:

    ```bash
        $ php vendor/bin/simple-phpunit
    ```

    or (Windows BAT file?)

    ```bash
       $ vendor\bin\simple-phpunit
    ```




Nice links:

- [good PHP Unit tutorial](https://jtreminio.com/2013/03/unit-testing-tutorial-introduction-to-phpunit/)

    -- keep CRAP < 5 ...