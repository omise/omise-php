SHELL := /bin/bash
include .env

coverage: 
	PUBLIC_KEY=${PUBLIC_KEY} SECRET_KEY=${SECRET_KEY} XDEBUG_MODE=coverage \
	./vendor/bin/phpunit --coverage-html reports --testdox

integration-test: 
	PUBLIC_KEY=${PUBLIC_KEY} SECRET_KEY=${SECRET_KEY} \
	./vendor/bin/phpunit --testdox

unit-test: 
	TEST_TYPE=unit ./vendor/bin/phpunit --testdox
