<?php

declare(strict_types=1);

use Nette\CodeChecker\Result;
use Nette\CodeChecker\Tasks;
use Tester\Assert;

require __DIR__ . '/bootstrap.php';


test(function () {
    $result = new Result;
    Tasks::tabIndentationPhpChecker("a
a
\tb
\t\tc
", $result);
    Assert::same([], $result->getMessages());
});


test(function () {
    $result = new Result;
    Tasks::tabIndentationPhpChecker("<?php echo \"a\tb\" ?>", $result);
    Assert::same([], $result->getMessages());
});


test(function () {
    $result = new Result;
    Tasks::tabIndentationPhpChecker("<?php echo 'a\tb' ?>", $result);
    Assert::same([], $result->getMessages());
});

test(function () {
    $result = new Result;
    Tasks::tabIndentationPhpChecker("a
a
\x20b
\x20\x20c
", $result);
    Assert::same([], $result->getMessages());
});


test(function () {
    $result = new Result;
    Tasks::tabIndentationPhpChecker("<?php echo \"a\x20b\" ?>", $result);
    Assert::same([], $result->getMessages());
});


test(function () {
    $result = new Result;
    Tasks::tabIndentationPhpChecker("<?php echo 'a\x20b' ?>", $result);
    Assert::same([], $result->getMessages());
});


test(function () {
    $result = new Result;
    Tasks::tabIndentationPhpChecker("<?php echo '
a
b
' ?>
a
 \x20\tb
", $result);
    Assert::same([[Result::ERROR, 'Mixed tabs and spaces to indent', 6]], $result->getMessages());
});