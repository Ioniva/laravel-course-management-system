# Laravel - Course Management System

This is a web application for creating and consulting school schedules and marks, allowing students to consult and create the different times for each subject of the course they are enrolled in.

This project was made using only Laravel (PHP), Javascript and AdminLTE.

-   Laravel 8+ framework for the application server side logic.
-   JavaScript for the application client side logic.
-   [AdminLTE template]() (based on Bootstrap 4.6) for the page styling.

## Getting Started

They are multiple ways to install.

1. As developer mode, by running the following command:
    ```
    $ php artisan serve
    ```
2. Running the application from a web server like Apache.

    `NOTE:` Recommended to use XAMPP, because we use this environment to develop our product.

### 1. Download the project

Always recommended to download from GitHub the latest release for new features.

### 2. Configure the db connection

Once the project is opened, modify the `config` file values to be able to connect to the database. This **config file is located in** `./config/database.php`.

**Database for testing**

This project contains a copy of the database for testing purposes,

1. Migrate using artisan's migrate command. The migrate:fresh commando will drop all tables from the database and then execute the migrate command:

    ```
        $ php artisan migrate:fresh
    ```

2. Use the dump file. File location `./Dump20220526.sql`

### 3. Run the application

Finally, the only thing left to do is to access the website. Depending on the access mode chosen previously, you will access via one URL or another.

## License

LIMA is an open source project that is licensed under [GPL](https://opensource.org/licenses/GPL-2.0).
