# Laravel Weather Forecast Project

This project is a Laravel-based application that retrieves weather forecast data from the OpenWeatherMap API.

## Prerequisites

Before cloning and running this project, ensure that you have the following:

- PHP (>= 7.4)
- Composer
- Git
- OpenWeatherMap API key

## Getting Started

To get started with this project, follow the steps below:

1. Clone the repository to your local machine:
   ```shell
   git clone https://github.com/your-username/laravel-weather-forecast.git
   ```

2. Navigate to the project directory:
   ```shell
    cd laravel-weather-forecast
   ```

3. Install the project dependencies using Composer:
   ```shell
    composer install
   ```

4. Create a copy of the `.env.example` file and name it `.env`:
   ```shell
    cp .env.example .env
   ```

5. Update the `.env` file with your OpenWeatherMap API key:
   ```shell
    WEATHER_FORECAST_API_KEY=YOUR_API_KEY
   ```
Replace YOUR_API_KEY with your actual OpenWeatherMap API key.

## Usage

1. To get the current weather for a specific location:
   ```shell
    php artisan current {location} [--u|--units={metric|imperial}]
   ```
Example:
   ```shell
    php artisan current Havana,CU -uimperial    
   ```

2. To get the weather forecast for a specific location:
   ```shell
    php artisan forecast {location} [--d|--days={1-5}] [--u|--units={metric|imperial}]
   ```
   OR:
   ```shell
    php artisan forecast:ask
   ```
Example:
   ```shell
    php artisan forecast Madrid,ES --units=imperial --days=4 
   ```
   OR:
   ```shell
    php artisan forecast:ask

    How many days to forecast? [1]:
    > 1

    What unit of measure? [metric]:
    [0] metric
    [1] imperial
    > 1
   ```