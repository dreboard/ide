<?php
/*
 * Code sections for populating saved select
 * */
return [
    'output' => '<p>code output will be here</p>',
    'sections' => [
        'code' => ['arrays', 'strings', 'oop', 'regex', 'command'],
        'database' => ['db'],
        'files' => ['file']
    ],
    'characters' => [
        '#', '&', ';', '`', '|', '*', '?', '~', '<', '>', '^', '(', ')',
        '[', ']', '{', '}', '$', '\\', ',', '\x0A', '\xFF'],

    'str_funcs' => [1 => 'explode ', 2 => 'implode ', 3 => 'strip_tags ', 4 => 'htmlentities ', 5 => 'html_entity_decode ', 6 => 'htmlspecialchars ', 7 => 'htmlspecialchars_decode ', 8 => 'strtolower ', 9 => 'strtoupper ', 10 => 'str_replace ', 11 => 'lcfirst ', 12 => 'ucfirst ', 13 => 'ucwords ', 14 => 'wordwrap ', 15 => 'strlen ', 16 => 'count ', 17 => 'trim ', 18 => 'ltrim ', 19 => 'rtrim ', 20 => 'print ', 21 => 'printf ', 22 => 'substr ', 23 => 'strstr ', 24 => 'strcmp ', 25 => 'str_pad ', 26 => 'str_split ', 27 => 'str_repeat ', 28 => 'str_shuffle ', 29 => 'md5 ', 30 => 'similar_text',]
];