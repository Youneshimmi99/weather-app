<?php

namespace App\Services;

use GuzzleHttp\Client;

class WeatherForecastService
{
    public function getWeatherForecast($location, $units, $days)
    {
        $count = 8 * $days;

        $client = new Client();
        $apiKey = env('WEATHER_FORECAST_API_KEY');

        $url = "https://api.openweathermap.org/data/2.5/forecast?q={$location}&units={$units}&appid={$apiKey}&cnt={$count}";

        try {
            $response = $client->get($url);
            $data = json_decode($response->getBody(), true);
            $forecasts = $data['list'];

            $city = $data['city']['name'];
            $countryCode = $data['city']['country'];

            $response = [];

            $response['city'] = "$city ($countryCode)";

            $i = 0;

            foreach ($forecasts as $key => $forecast) {
                if ($key % 8 === 0) {
                    $date = date('M d, Y', $forecast['dt']);
                    $response['list'][$i]['date'] = $date;

                    $weather = $forecast['weather'][0]['main'];
                    $response['list'][$i]['weather'] = "> Weather: $weather";

                    $temperature = $forecast['main']['temp'];
                    $response['list'][$i]['temperature'] = "> Temperature: $temperature °" . ($units === 'imperial' ? 'F' : 'C');
                    
                    $i++;
                }
            }

            return $response;
        } catch (\Exception $e) {
            throw new \Exception('Failed to fetch weather data. Please check your location and API key.');
        }
    }
}
