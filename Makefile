SHELL := /bin/bash
include .env

coverage: 
	PUBLIC_KEY=${PUBLIC_KEY} SECRET_KEY=${SECRET_KEY} XDEBUG_MODE=coverage \
	./vendor/bin/phpunit --coverage-html reports --testdox

test: 
	PUBLIC_KEY=${PUBLIC_KEY} SECRET_KEY=${SECRET_KEY} \
	./vendor/bin/phpunit --testdox
	