## Installation

Clone the repository

    git clone https://github.com/dan-dia/task-5-fullstack.git

Switch to the repo folder

    cd task-5-fullstack

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate --ansi
    
Run the database migrations and seeders

    php artisan migrate --seed
    
Run Storage Link
    
    php artisan storage:link

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000
