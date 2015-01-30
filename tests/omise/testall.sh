#!/bin/sh
file=*Test.php
for testfile in ${file}
do
phpunit --colors $testfile
done
