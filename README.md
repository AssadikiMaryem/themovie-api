## About Trending Movies application

THis application allows you to dicover millions of trending movies per day per week.

## Requirements
- PHP version 8.1
- Composer
- Database (MySQL)

## Installation

- Clone project
- Install composer dependencies, (composer install)
- Generate the application key (php artisan key:generate)
- Compile assests (npm run watch)
- Configure the database settings in the .env file
- Add new line in env file to set the variable THE_MOVIE_DB_API_KEY and provide the TMDB Api Key
- Run the database migration

- Run the artisan consol command to update trending movies (php artisan trending-movies:update
  )
- Run the schedule:work artisan command to update trending movies once a day(php artisan schedule:work)

## Usage
1) Start the Application
2) Register for an account to use the application. Follow these steps:
- Open the application in a web browser.
- Click on the "Register" link.
- Fill in the required registration details, including username, email, and password.
- Click "Register" to create your account.

3) Explore trending movies
- Log in using the credentials you used during registration.
- Navigate to the "Movies" section.
- The application fetches and displays a list of trending movies from TMDb per day or per week (Using Livewire to filter the movies, search by name, and list the result data).
- Explore movie details, ratings, and other relevant information by clicking in the poster movie.

## Websites used for developement
- Laravel [website](https://laravel.com/docs/10.x/).
- Livewire [website](https://laravel-livewire.com/).
- Jetstream [website](https://jetstream.laravel.com/introduction.html).
- [TailwindCss](https://tailwindcss.com/)
