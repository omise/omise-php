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
    'blank_line_before_statement' => ['statements' => ['break', 'case', 'continue', 'declare', 'default', 'exit', 'goto', 'return', 'switch', 'throw', 'try']],

    // This is just prettier / easier to read.
    'concat_space' => ['spacing' => 'one'],

    // Visibility annotations are not supported by php5.6
    'visibility_required' => false,
])
->setIndent(str_pad('', 4))
->setLineEnding("\n")
->setFinder($finder);