<?php

namespace SnippetBuilder;

use SnippetBuilder\FileHandlerException;

/**
 * Class FileHandler
 *
 * @author Adriano Rosa (http://adrianorosa.com)
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */
class FileHandler
{
    private $_result = [];

    /**
     * Write Files
     *
     * @param string
     * @throws SnippetBuilder\FileHandlerException
     */
    public function write($filename, $content)
    {
        if ( !is_dir( dirname($filename) ) ) {
            throw new FileHandlerException(
                sprintf('Snippets directory not found: %s', dirname($filename))
            );

            return false;
        }

        $success_message = ( !file_exists($filename) ) ? "Created new file --> %s" : "Updated file --> %s";

        if ( ! $handle = @fopen($filename, 'w')) {
            throw new FileHandlerException(
                sprintf('Unable to read a file %s due the file permissions', $filename)
            );

            return false;
        }

        flock($handle, LOCK_EX);

        if ( fwrite($handle, $content) === FALSE ) {
            throw new FileHandlerException(
                sprintf("Unable to write a file %s due the file permissions --> %s", $filename)
            );

            return false;
        }

        flock($handle, LOCK_UN);
        fclose($handle);

        $this->setOutput('success', sprintf($success_message, basename($filename)));

        return $this;
    }

    /**
     * Clear directory Files
     *
     * @param string $path The directory to unlink files
     * @throws SnippetBuilder\FileHandlerException
     */
    function clearDir($path)
    {
        $path = rtrim($path, '/\\');

        if (is_dir($path)) {
            if ($dh = opendir($path)) {

                while (($filename = readdir($dh)) !== false) {

                    if ( $filename !== '.' && $filename !== '..' ) {

                        if ( FALSE === @unlink( $path . DIRECTORY_SEPARATOR . $filename) ) {

                            throw new FileHandlerException(
                                sprintf('Permission Denied: Unable to unlink %s', $filename)
                            );
                            return false;
                        }
                    }
                }
                closedir($dh);
            }
        }
    }

    public function setOutput($type, $string = null)
    {
        if ( $type === 'success' ) {

            $message = sprintf("✔ %s", $string);
            $pretty = "\033[0;32m";

        } else {

            $message = sprintf("✗ Error %s", $string);
            $pretty = "\033[0;31m";
        }

        $message = $pretty . $message . "\033[0m" . PHP_EOL;

        $this->_result[][$type] = $message;

        return $this;
    }

    public function getOutput()
    {
        $output = '';
        $count = 0;

        foreach ($this->_result as $result) {

            if ( isset($result['success']) ) {
                $output .= $result['success'];
            } elseif ( isset($result['error']) ) {
                $count --;
                $output .= $result['error'];
            }

            $count++;
        }

        $output .= "------------------------------". PHP_EOL;
        $output .= $count . ' snippets has been created' . PHP_EOL;
        $output .= "------------------------------". PHP_EOL;
        return $output;
    }
}
