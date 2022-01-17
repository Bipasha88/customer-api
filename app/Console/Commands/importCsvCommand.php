<?php

namespace App\Console\Commands;

use App\Models\Customer;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class importCsvCommand extends Command
{
    protected $signature = 'store:customer-data';

    protected $description = 'Get customer data from a csv file and store into database';

    public function __construct()
    {
        parent::__construct();
    }

    function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1500, $delimiter)) !== false) {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }

    public function handle()
    {
        echo "Starting storing customer's data from csv file. It will take some time please wait.....";
        $file = public_path('file/customers.csv');

        $customerArr = $this->csvToArray($file);

        set_time_limit(0);
        for ($i = 0; $i < count($customerArr); $i++) {
            $customer = Customer::firstOrCreate($customerArr[$i]);

            $address = $customer->city;
            $prepAddr = str_replace(' ', '+', $address);
            $client = new Client();
            $result = $client->get('https://maps.googleapis.com/maps/api/geocode/json?address='.$prepAddr.'&key='.env( 'GOOGLE_MAPS_KEY' ))->getBody();
            $json = json_decode($result);

            if($json->status != 'ZERO_RESULTS') {
                $customer->latitude = $json->results[0]->geometry->location->lat;
                $customer->longitude = $json->results[0]->geometry->location->lng;
            }
            $customer->save();
        }

        echo "\n";
        echo "All data stored with latitude and longitude value into the database customers table.";
        return 'Csv Data are stored';
    }
}
