<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://adminlte.io/wp-content/uploads/2021/03/logo.png" width="400" alt="Admin LTE Logo"></a></p>

## About Laravel

This project is made in Laravel version 10. In this project i used a Admin LTE with breeze installtion. User have not to worry about assetes & folder path for admin side.

## Installation & usage
- For Install you have to clone this repo or you can fire this command as well.

```
git clone https://github.com/Nihirz/laravel-10-adminlte.git
```

- Go into folder

```
cd laravel-10-adminlte
```

- After the installation you have to update the vendor folder you can update the vendor folder using this command.

```
composer update
```

- After the updation you have to create the ```.env``` file via this command.

```
cp .env.example .env
```

- Now you have to generate the product key.

```
php artisan key:generate
```

- Now migrate the database tables.

```
php artisan migrate
```

- We are done here. Now you have to just serve your project.

```
php artisan serve
```

## Security Vulnerabilities

If you discover a security vulnerability within this project, please send an e-mail to Nihir Zala via [testnihir@gmail.com](mailto:testnihir@gmail.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
