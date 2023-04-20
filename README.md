## E-Stations

E-Stations is a Laravel-based web application that allows users to find and view information about electric vehicle
charging stations in a given area. This application uses the Google Maps API to display the locations of charging
stations on a map, as well as various filters and search options to help users find the station they need.

## Installation

To run e-stations locally, you need to have PHP 8.2 or later and Composer installed on your machine. Follow these steps:

- **Clone the repository: git clone https://github.com/kaliush/e-stations.git**
- **Move into the project directory: cd e-stations**
- **Install dependencies: composer install**
- **Create a .env file: cp .env.example .env**
- **Generate a new application key: php artisan key:generate**
- **Configure your database in the .env file**
- **Run database migrations: php artisan migrate**
- **Seed the database with sample data (optional): php artisan db:seed**
- **Start the application: php artisan serve**
- **Visit http://localhost:8000 in your browser**

## Usage

### Search for stations

To search for stations, visit the homepage and enter your city and/or whether you want to see only open stations. The
app will return a list of matching stations.

### Create a new station

To create a new station, click the "New Station" button on the homepage and fill out the form.

### Edit a station

To edit an existing station, click the "Edit" button next to the station on the homepage and make your changes in the
form.

### Delete a station

To delete a station, click the "Delete" button next to the station on the homepage.

### Search for nearest open station

To search for nearest open station, enter your latitude and longitude and click on find. The app will redirect you to
the page with the nearest station that is currently open.
