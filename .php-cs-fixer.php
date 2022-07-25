<?php

$finder = Symfony\Component\Finder\Finder::create()
    ->exclude(['vendor'])
    ->name('*.php')
    ->in(__DIR__);

$config = new PhpCsFixer\Config();
return $config->setRules([
    '@PSR12' => true,
    'strict_param' => false,
    'no_unused_imports' => true,
    'indentation_type' => true,
    'array_indentation' => false,
    'single_quote' => true,
    'method_chaining_indentation' => true,
    'trim_array_spaces' => true,
    'array_syntax' => ['syntax' => 'short'],
    'binary_operator_spaces' => [
        'operators' => [
          '=>' => 'single_space',
          '='  => 'single_space',
          '+=' => 'single_space',
          '-=' => 'single_space',
          '>'  => 'single_space',
          '<'  => 'single_space',
          '<=' => 'single_space',
          '>=' => 'single_space',
          '||' => 'single_space',
          '&&' => 'single_space',
        ],
    ],
    'no_extra_blank_lines' => ['tokens' => ['attribute', 'break', 'case', 'continue', 'curly_brace_block', 'default', 'extra', 'parenthesis_brace_block', 'return', 'square_brace_block', 'switch', 'throw', 'use']],
])
->setIndent(str_pad('', 4))
->setLineEnding("\n")
->setFinder($finder);