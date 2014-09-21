#!/usr/bin/php
<?php

require_once 'src/SnippetBuilder/autoloader.php';

use SnippetBuilder\Builder;

$build = new Builder('snippets');
$build->run();
