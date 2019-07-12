# PhpDev

PhpDev is OOP task attempted by Krzysztof Buczynski. 

## Installation

Use the package manager NPM to install JavaScript Libraries.

Use the Package manger Composer to install PHP libraries. 

NPM packages can be found in **/public/resources**
Composer packages can be found in the root directory of the project. 

```bash
npm install
composer install
```

## Usage
Please make sure you upload MySQL dump into your database and provide correct connection details to **/config/db.json**
The dump can be found in **/SQLDump** directory. 

Just run the project using your webserver starting from **/public/index.html**

To test the database connection run PHP unit test using the command from project directory. 

```bash
./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/Lib/MySqliTest.php 

```