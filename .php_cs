<?php

/**
 * PHP-CS-Fixer.
 *
 * @see <https://github.com/FriendsOfPHP/PHP-CS-Fixer>
 */

return PhpCsFixer\Config::create()
    ->setFinder(PhpCsFixer\Finder::create()
        ->exclude([
            'vendor',
        ])
        ->in(__DIR__))
    ->setRiskyAllowed(true)
    ->setUsingCache(false)
    ->setRules([
        '@PSR2'                                       => true,
        '@PHP71Migration'                             => true,
        'binary_operator_spaces'                      => [
            'align_double_arrow' => true,
            'align_equals'       => true,
        ],
        'blank_line_after_namespace'                  => true,
        'blank_line_after_opening_tag'                => true,
        'blank_line_before_return'                    => true,
        'declare_equal_normalize'                     => ['space' => 'single'],
        'dir_constant'                                => true,
        'encoding'                                    => true,
        'hash_to_slash_comment'                       => true,
        'include'                                     => true,
        'line_ending'                                 => true,
        'linebreak_after_opening_tag'                 => true,
        'lowercase_constants'                         => true,
        'lowercase_cast'                              => true,
        'mb_str_functions'                            => true,
        'method_separation'                           => true,
        'no_blank_lines_after_phpdoc'                 => true,
        'no_empty_phpdoc'                             => true,
        'no_closing_tag'                              => true,
        'no_multiline_whitespace_around_double_arrow' => true,
        'no_trailing_comma_in_singleline_array'       => true,
        'no_short_echo_tag'                           => true,
        'no_spaces_after_function_name'               => true,
        'no_unused_imports'                           => false,
        'no_whitespace_in_blank_line'                 => true,
        'non_printable_character'                     => true,
        'normalize_index_brace'                       => true,
        'object_operator_without_whitespace'          => true,
        'ordered_class_elements'                      => true,
        'phpdoc_add_missing_param_annotation'         => true,
        'phpdoc_align'                                => true,
        'phpdoc_annotation_without_dot'               => true,
        'phpdoc_indent'                               => true,
        'phpdoc_order'                                => true,
        'phpdoc_separation'                           => true,
        'phpdoc_types'                                => true,
        'phpdoc_return_self_reference'                => true,
        'single_blank_line_at_eof'                    => true,
        'single_blank_line_before_namespace'          => true,
        'single_line_after_imports'                   => true,
        'single_quote'                                => true,
        'space_after_semicolon'                       => true,
        'standardize_not_equals'                      => true,
        'ternary_operator_spaces'                     => true,
        'trim_array_spaces'                           => true,
        'ternary_to_null_coalescing'                  => true,
        'visibility_required'                         => true,
        'whitespace_after_comma_in_array'             => true,
        'array_syntax'                                => ['syntax' => 'short'],
    ]);
