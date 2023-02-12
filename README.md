# Router
> sample routes handler

## Install


```tree
 composer create-project reneknox/router:0.1
```
## Supported Versions

| Release | php 7.4  | php 8.0 | php 8.1  | php 8.2  |
|---------|----------|----------|----------|----------|
| 0.1 | &#x2713; | &#x2713;|&#x2713;|&#x2713;|


## Usage

```php

use Reneknox\Router\Router;
use Reneknox\Router\Route;

Route::get('/start', fn() => 'start');

Route::get('/home', function () {
    return 'Home';
});

$router = new Router();

$router->serve($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

````
## Directory structure

```tree
├───src
├───tests
```
### Tested Platform

  ```text
  - Ubuntu 
  - Windows 10
  ```

## To run test

  ```text
  composer test
  ```

## License

> MIT

## Authors

- [Omar Hossam El-Din Kandil](https://www.linkedin.com/in/omar-hossameldin-kandil-74633a1bb/)
