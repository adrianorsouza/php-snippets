PHP snippets - The missing snippets for Sublime Text editor
====

Sublime Text is awesome and already comes with a bunch of PHP snippets, but there are few useful snippets missing in there that are shared in this repository.

Compatible with Sublime Text 2 and Sublime Text 3

Installation 
---
#### With Package Control

* Open the [Sublime Package Control](https://sublime.wbond.net/installation). `Main menu -> Preferences -> Package Control` 
* In the command palette select `install package` and search for: `PHP snippets`.

#### Manual

* Open the package folder. `Main menu -> Preferences -> Browse Packages`.

Download the latest [release](https://github.com/adrianorsouza/php-snippets/archive/master.zip) then unpack it within your `Packages/User` folder.

Alternatively you may want to install this package using git by cloning this repository within your `Packages/User` folder:

	git clone https://github.com/adrianorsouza/php-snippets.git

PHP snippets usage 
----
### $_SERVER VARIABLES

|Tab trigger | produces |
|------------| ---------|
|`SERVER`    |`$_SERVER['REMOTE_ADDR'];`|

Available values:

 * USER
 * HOME
 * FCGI_ROLE
 * QUERY_STRING
 * REQUEST_METHOD
 * CONTENT_TYPE
 * CONTENT_LENGTH
 * SCRIPT_NAME
 * SHELL
 * REQUEST_URI
 * DOCUMENT_URI
 * DOCUMENT_ROOT
 * SERVER_PROTOCOL
 * SCRIPT_FILENAME
 * GATEWAY_INTERFACE
 * PATH
 * PATH_TRANSLATED
 * SERVER_SOFTWARE
 * REMOTE_ADDR
 * REMOTE_PORT
 * SERVER_ADDR
 * SERVER_PORT
 * SERVER_NAME
 * SSH_AUTH_SOCK
 * REDIRECT_STATUS
 * HTTP_HOST
 * HTTP_CONNECTION
 * HTTP_REFERER
 * HTTP_CACHE_CONTROL
 * HTTP_AUTHORIZATION
 * HTTP_ACCEPT
 * HTTP_USER_AGENT
 * HTTP_DNT
 * HTTP_ACCEPT_ENCODING
 * HTTP_ACCEPT_LANGUAGE
 * HTTP_COOKIE
 * PHP_SELF
 * PHP_AUTH_DIGEST
 * REQUEST_TIME_FLOAT
 * REQUEST_TIME

### PHP MAGIC CONSTANTS
| Tab trigger  | produces |
|------------  |----------|
|`__`          |`__LINE__`|

Available values:

 * \__LINE__
 * \__FILE__
 * \__DIR__
 * \__FUNCTION__
 * \__CLASS__
 * \__TRAIT__
 * \__METHOD__
 * \__NAMESPACE__

### PHP CONSTANTS
PHP may have over thousands of predefined and reserved constants depending on its installation on your system, so would be bad ideia to create snippets for all of them, so I decided to create snippets for only the most common. The PHP constants available are listed below, each one may have many others related to them, for example to list all CURL library constants you would type `CURL_` :

|tab trigger |produces|
|-----------|--------|
|CURLOPT_   |`CURLOPT_PUT` ...|
|CURL_      |`CURL_SSLVERSION_SSLv2` ...|
|CRYPT_     |`CRYPT_BLOWFISH` ...|
|DATE_      |`DATE_ISO8601` ...|
|DIRECTORY_ |`DIRECTORY_SEPARATOR` ...|
|E_         |`E_NOTICE` ...|
|FILTER_    |`FILTER_VALIDATE_EMAIL` ...|
|JSON_      |`JSON_PRETTY_PRINT` ...|
|LIBXML_    |`LIBXML_COMPACT` ...|
|LC_        |`LC_MESSAGES` ...|
|MCRYPT_    |`MCRYPT_BLOWFISH` ...|
|PATH_      |`PATH_SEPARATOR` ...|
|PHP_       |`PHP_VERSION` ...|
|PHP_URL_   |`PHP_URL_HOST` ...|

	
## Building snippets
There is a build branch that holds the script to auto generate snippets.

Run the following command from the command line to make a new build:

	git checkout build
	./Build.php

###Author
Adriano Rosa
[@adrianorosa](https://twitter.com/adrianorosa)

###License

This software is licensed under the MIT License. Please read LICENSE for information on the software availability and distribution.
