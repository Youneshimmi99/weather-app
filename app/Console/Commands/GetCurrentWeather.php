<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;

class GetCurrentWeather extends Command
{
    protected $signature = 'current {location=Santander,ES} {--u|units=metric}';

    protected $description = 'Get the current weather data for the given location';

    public function handle()
    {
        $location = $this->argument('location');
        $units = $this->option('units');

        $client = new Client();
        $apiKey = '31f89d93e1986450106b0d57152a28a5';

        $url = "https://api.openweathermap.org/data/2.5/weather?q={$location}&units={$units}&appid={$apiKey}";

        try {
            $response = $client->get($url);
            $data = json_decode($response->getBody(), true);

            $city = $data['name'];
            $countryCode = $data['sys']['country'];
            $date = date('M d, Y', $data['dt']);
            $weather = $data['weather'][0]['main'];
            $temperature = $data['main']['temp'];

            $this->info("$city ($countryCode)");
            $this->info("$date");
            $this->info("> Weather: $weather");
            $this->info("> Temperature: $temperature °" . ($units === 'imperial' ? 'F' : 'C'));
        } catch (\Exception $e) {
            $this->error('Failed to fetch weather data. Please check your location and API key.');
        }
    }
}
