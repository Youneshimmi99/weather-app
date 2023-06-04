<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\WeatherForecastService;

class GetWeatherForecast extends Command
{
    private const MAX_DAYS = 5;

    protected $signature = 'forecast {location=Santander,ES} {--d|days=1} {--u|units=metric}';

    protected $description = 'Get the weather forecast for the given location';

    protected $weatherForecastService;

    public function __construct(WeatherForecastService $weatherForecastService)
    {
        parent::__construct();

        $this->weatherForecastService = $weatherForecastService;
    }

    public function handle()
    {
        $location = $this->argument('location');
        $units = $this->option('units');
        $days = $this->option('days');

        if($days > self::MAX_DAYS) {
            $this->error('You can only retrieve 5 days');
            return;
        }

        try {
            $response = $this->weatherForecastService->getWeatherForecast($location, $units, $days);

            $this->info($response['city']);

            foreach($response["list"] as $list) {
                $this->info($list['date']);
                $this->info($list['weather']);
                $this->info($list['temperature']);
            }
        } catch (\Exception $e) {
            $this->error('Failed to fetch weather data. Please check your location and API key.');
        }
    }
}
