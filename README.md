# Twitter App Backend, Frontend

Twitter app using Laravel, React, Redux.

## Dependencies
Linux or Mac OS

## Installation & setup

serving via docker

```shell
git clone git@github.com:yousefdev20/twitter.git

sudo bash ./bin/setup.sh

google-chrome http://localhost:83 --incognito
```

## Demo accounts

```javascript
username: "user@twitter.com"
password: secret

username: "follower@twitter.com"
password: secret

username: "follower1@twitter.com"
password: secret
```

## Configuration

Add or Modify the config in your entry point `config/twitter.php` file.

```php
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | The max tweets per page (Pagination)
    |--------------------------------------------------------------------------
    |
    | This option controls the max number of records
    | that can return to the client once he uses our API.
    |
    | Supported: "int"
    |
    */

    'per_page' => 10,

    /*
    |--------------------------------------------------------------------------
    | rate limiter
    |--------------------------------------------------------------------------
    |
    | Here you may specify a rate limiter that will be applied to all routes
    | we have inside application applied only on API.
    |
    */

    'rate_limiter' => 60,
];

```

## Maintainer
Yousef [yousef.dev20@gmail.com](mailto:yousef.dev20@gmail.com)

## Getting Help

If you're stuck getting something to work, or need to report a bug, please [post an issue in the Github Issues for this project](https://github.com/yousefdev20/twitter/issues).
## Contributing

If you're interested in contributing code to this project, clone it by running:

```shell
git clone git@github.com:yousefdev20/twitter.git
```

## License

This project is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
