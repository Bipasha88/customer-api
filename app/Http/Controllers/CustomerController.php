<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
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

    public function importCsv()
    {
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

        return 'Csv Data are stored';
    }

    public function mapAdress()
    {
        $address = "Lyon, WV";
        $prepAddr = str_replace(' ', '+', $address);
        $client = new Client();
        $result = $client->get('https://maps.googleapis.com/maps/api/geocode/json?address='.$prepAddr.'&key='.env( 'GOOGLE_MAPS_KEY' ))->getBody();
        $json = json_decode($result);
        dd($json->status);
        $address->lat = $json->results[0]->geometry->location->lat;
        $address->lng = $json->results[0]->geometry->location->lng;
    }


}
