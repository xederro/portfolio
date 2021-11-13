<?php
declare(strict_types=1);

namespace src\Model;

use PDO;
use src\Exception\StorageException;
use src\Utils\Request;

class Weather extends AbstractModel implements InterfaceModel
{

    /**
     * reads weather data from database
     *
     * @param Request $request
     * @return array
     * @throws StorageException
     */
    public function read(Request $request): array
    {
        try {
            $type = $request->postParam('data');

            $query = match ($type) {
                "data" => "SELECT DATE_FORMAT(timestamp, '%H:%i') AS 'time', temperature, pressure, humidity, light FROM mesures ORDER BY timestamp desc LIMIT 1",
                "hour" => "SELECT DATE_FORMAT(timestamp, '%H:%i') AS 'time', temperature, pressure, humidity, light FROM mesures WHERE timestamp >= DATE_SUB(NOW(), INTERVAL '1' HOUR) ORDER BY timestamp",
                "day" => "SELECT DATE_FORMAT(timestamp, '%a %H:00') AS 'time', AVG(temperature) AS 'temperature', AVG(pressure) AS 'pressure', AVG(humidity) AS 'humidity', AVG(light) AS 'light' FROM mesures WHERE timestamp >= DATE_SUB(NOW(), INTERVAL '1' DAY) GROUP BY DATE_FORMAT(timestamp, '%a %H:00') ORDER BY DAY(timestamp), hour(timestamp)",
                "week" => "SELECT DATE_FORMAT(timestamp, '%m-%e') AS 'time', AVG(temperature) AS 'temperature', AVG(pressure) AS 'pressure', AVG(humidity) AS 'humidity', AVG(light) AS 'light' FROM mesures WHERE timestamp >= DATE_SUB(NOW(), INTERVAL '1' WEEK) GROUP BY DAY(timestamp) ORDER BY MONTH(timestamp), DAY(timestamp)",
                "month" => "SELECT DATE_FORMAT(timestamp, '%m-%e') AS 'time', AVG(temperature) AS 'temperature', AVG(pressure) AS 'pressure', AVG(humidity) AS 'humidity', AVG(light) AS 'light' FROM mesures WHERE timestamp >= DATE_SUB(NOW(), INTERVAL '1' MONTH) GROUP BY DAY(timestamp) ORDER BY MONTH(timestamp), DAY(timestamp)",
                "year" => "SELECT DATE_FORMAT(timestamp, '%b') AS 'time', AVG(temperature) AS 'temperature', AVG(pressure) AS 'pressure', AVG(humidity) AS 'humidity', AVG(light) AS 'light' FROM mesures WHERE timestamp >= DATE_SUB(NOW(), INTERVAL '1' YEAR) GROUP BY MONTH(timestamp) ORDER BY MONTH(timestamp)",
                default => '',
            };

            return $this->dbConnection->query($query)->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (\Exception $e){
            throw new StorageException('There was a problem while trying to get Weather data');
        }
    }
}