<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://vascomm.co.id/wp-content/uploads/2022/09/cropped-JKBSDKBASD.png" width="400" alt="Laravel Logo"></a></p>


## About

This app for vasscomm technical test

goals items :

- Fitur get list terdapat param query take, skip search
- Menggunakan method yang sesuai
- Format respon terdiri dari : code, message, data
- Implementasi oauth2 pada API
- Untuk fitur delete implementasi soft delete
- Mengimplementasikan 2 role user (role admin dan role user)
- Implementasi seeder dan migration
- Implementasi validasi parameter
- 
## API Docs

The API documentation is here **Postman Collection File** `(postman_collection.json)`, You can also import into your Postman App.

## How to install

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/master/installation)

Clone the repository

    git clone git@github.com:bahriid/vasscomm-technical-test-api.git

Switch to the repo folder

    cd vasscomm-technical-test-api

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations and seeders (**Set the database connection in .env before migrating**)

    php artisan migrate --seed

Generate laravel passport token key for the security

    php artisan passport:install

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

**TL;DR command list**

    git clone git@github.com:bahriid/vasscomm-technical-test-api.git
    cd vasscomm-technical-test-api
    composer install
    cp .env.example .env
    php artisan key:generate

**Make sure you set the correct database connection information before running the migrations**

    php artisan migrate --seed
    php artisan passport:install    
    php artisan serve

## License

This Laravel app is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
