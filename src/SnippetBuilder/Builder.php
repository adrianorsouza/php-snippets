<?php

namespace SnippetBuilder;

use SnippetBuilder\FileHandler;
use SnippetBuilder\FileHandlerException;

/**
 * PHP Snippets generator
 *
 * @date 2014-09-20 15:37
 *
 * @author Adriano Rosa (http://adrianorosa.com)
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link https://github.com/adrianorsouza/php-snippets
 */
class Builder
{
	protected $path;
	protected $server_snippets = [
		  'USER',
		  'HOME',
		  'FCGI_ROLE',
		  'QUERY_STRING',
		  'REQUEST_METHOD',
		  'CONTENT_TYPE',
		  'CONTENT_LENGTH',
		  'SCRIPT_NAME',
		  'SHELL',
		  'REQUEST_URI',
		  'DOCUMENT_URI',
		  'DOCUMENT_ROOT',
		  'SERVER_PROTOCOL',
		  'SCRIPT_FILENAME',
		  'GATEWAY_INTERFACE',
		  'PATH',
		  'PATH_TRANSLATED',
		  'SERVER_SOFTWARE',
		  'REMOTE_ADDR',
		  'REMOTE_PORT',
		  'SERVER_ADDR',
		  'SERVER_PORT',
		  'SERVER_NAME',
		  'SSH_AUTH_SOCK',
		  'REDIRECT_STATUS',
		  'HTTP_HOST',
		  'HTTP_CONNECTION',
		  'HTTP_CACHE_CONTROL',
		  'HTTP_AUTHORIZATION',
		  'HTTP_ACCEPT',
		  'HTTP_USER_AGENT',
		  'HTTP_DNT',
		  'HTTP_ACCEPT_ENCODING',
		  'HTTP_ACCEPT_LANGUAGE',
		  'HTTP_COOKIE',
		  'PHP_SELF',
		  'PHP_AUTH_DIGEST',
		  'REQUEST_TIME_FLOAT',
		  'REQUEST_TIME',
		];

	/**
	 * Contructor
	 *
	 * @param string $dir Where to place the build snippets
	 * @return void
	 */
	public function __construct($dir = null) {

		date_default_timezone_set('UTC');
		$this->path = realpath('./') . DIRECTORY_SEPARATOR . $dir;
	}

	public function run()
	{
		return $this->make();
	}

	protected function make()
	{
		$file = new FileHandler();

		// --------------------------------------------
		// Build snippets for SERVER variables
		// --------------------------------------------
		foreach ($this->server_snippets as $item) {

			try {

				$content = '\$_SERVER[\''. $item .'\'];';
				$filename =  $this->setFilePath('PHP_SERVER_' . $item);

				$file->write( $filename, $this->snippet($content, 'SERVER', $item) );

			} catch(FileHandlerException $e) {

				$file->setOutput('error', $e->getMessage());
			}
		}

		$file->write( dirname($this->path) . '/last_build', date(DATE_RFC2822) . "\n" );
		echo $file->getOutput();
	}

	protected function snippet($content, $tabTrigger = 'PHP', $description = '', $scope = 'source.php')
	{
		return "<snippet>\n"
		. "    <content><![CDATA[{$content}]]></content>\n"
		. "    <tabTrigger>{$tabTrigger}</tabTrigger>\n"
		. "    <description>{$description}</description>\n"
		. "    <scope>{$scope}</scope>\n"
		. "</snippet>\n";
	}

	protected function setFilePath($filename)
	{
		return sprintf("{$this->path}/%s.sublime-snippet", $filename );
	}
}
