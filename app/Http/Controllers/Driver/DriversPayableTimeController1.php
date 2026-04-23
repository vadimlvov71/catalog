<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DriversTrips;
use Illuminate\Support\Facades\DB;

class DriversPayableTimeController extends Controller
{
    public function index()
    {
        return view('drivers.index');
    }

    public function uploadFile(Request $request)
    {
        $file = $request->file('image');
   
        //Display File Name
       /* echo 'File Name: '.$file->getClientOriginalName();
        echo '<br>';
    
        //Display File Extension
        echo 'File Extension: '.$file->getClientOriginalExtension();
        echo '<br>';
    
        //Display File Real Path
        echo 'File Real Path: '.$file->getRealPath();
        echo '<br>';
    
        //Display File Size
        echo 'File Size: '.$file->getSize();
        echo '<br>';
    
        //Display File Mime Type
        echo 'File Mime Type: '.$file->getMimeType();
    */
        //Move Uploaded File
        $destinationPath = 'uploads';
        $file->move($destinationPath, $file->getClientOriginalName());
        $drivers = $this->readCsv();
        $this->store($drivers);
        return view('drivers.times', compact('drivers'));
    }
    public function store($drivers)
    {
        
        foreach($drivers as $key => $driver_trip) {
            $trips = new DriversTrips;
            echo $driver_trip["driver_id"]."<br>";
            $trips->driver_id = $driver_trip['driver_id'];
            $trips->pickup = $driver_trip['pickup'];
            $trips->dropoff = $driver_trip['dropoff']; 
            $trips->save();  
        }
        //return redirect()->back()->with('status','Student Added Successfully');
    }
    public function readCsv()
    {
        //$filePath = storage_path('uploads/trip.csv');
        $filePath = public_path('uploads/trips.csv');
        $file = fopen($filePath, 'r');

        $header = fgetcsv($file);

        $users = [];
        while ($row = fgetcsv($file)) {
            $users[] = array_combine($header, $row);
        }

        fclose($file);

        return $users;
    }
    public function getTotalMinutesWithPassenger($orderBy = "DESC")
    {
        $statement = "
        select sum(TIMESTAMPDIFF(minute, trip_start, trip_end)) as total_minutes, t1.driver_id
        from
        (
        select DISTINCT pickup as trip_start, driver_id
        from drivers_trips
        ) as t1
        JOIN
        (
        select DISTINCT dropoff as trip_end, driver_id, pickup
        from drivers_trips
        ) as t2
        ON t1.trip_start = t2.pickup
        AND t1.driver_id = t2.driver_id
        GROUP BY t1.driver_id
        ";
        $drivers_trips_total = DB::select($statement);
         
        return $drivers_trips_total;


        $statement = "
        SELECT driver_id, sum(TIMESTAMPDIFF(minute, pickup, dropoff)) as total_minutes 
        FROM drivers_trips GROUP BY driver_id ORDER BY total_minutes DESC
        ";
        //sum(DATEDIFF(minute, pickup, dropoff)) as
        $statement1 = "
        SELECT driver_id, TIMESTAMPDIFF(minute, pickup, dropoff) as total_minutes
        FROM drivers_trips WHERE driver_id = 24277 
        ";
        $statement2 = "
        SELECT driver_id, TIMESTAMPDIFF(minute, pickup, dropoff) as total_minutes
        FROM drivers_trips WHERE id = 428
        ";
        //$drivers = DB::select($statement);
       $drivers = DB::table('drivers_trips')
            ->select(DB::raw('driver_id, sum(TIMESTAMPDIFF(minute, pickup, dropoff)) as total_minutes'))
             //->where('status', '<>', 1)
            ->groupBy('driver_id')
            ->orderBy('total_minutes', $orderBy)
            ->get();
        $array = [];
        $rusult = [];
        foreach ($drivers as $driver) {
            $array["driver_id"] = $driver->driver_id;
            $array["total"] = $driver->total_minutes;
            
            $rusult[] = $array;
            //echo $driver->driver_id."  total_minutes: ".$driver->total_minutes."<br>";

            //echo $driver->driver_id."  pickup: ".$driver->pickup."  dropoff: ".$driver->dropoff."<br>";
        }
        return $rusult;
    }
    /**
     * @param string $order
     * 
     * @return json
     */
    public function angularOrder($order)
    {
        $drivers = $this->getTotalMinutesWithPassenger($order);
        return response()->json($drivers);
    }
    public function angular()
    {
       $drivers = $this->getTotalMinutesWithPassenger();
        echo "<pre>";
        print_r($drivers);
        echo "</pre>";
        exit;
        return response()->json($drivers);
       /* return [
            [
                'userId' => 1,
                'id' => 2,
                'title' => 'Abigail',
                'body' => 'CA',
                
            ],
        ];*/
       /* return response()->json([
            [
                'driver_id' => 1,
                'total' => 2,
                
                
            ],
            [
                'driver_id' => 2,
                'total' => 2,
                
            ]
        ]);*/
    }
}
