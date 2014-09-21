#!/usr/bin/env php
<?php

require_once 'src/SnippetBuilder/autoloader.php';

use SnippetBuilder\Builder;

$args = isset($argv) ? $argv : array();

$build = new Builder('snippets');
$build->run($args);
