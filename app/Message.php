<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Message extends Model {
    protected $fillable = array('latitude', 'longitude', 'message');

    protected static function getFromCoordinates($latitude, $longitude, $distance)
    {
        $earthRadiusKM = 6371;

        return DB::table("messages")
                 ->select(DB::raw("message, ({$earthRadiusKM} * acos(cos(radians({$latitude})) * cos(radians(latitude)) * cos(radians({$longitude}) - radians(longitude)) + sin(radians({$latitude})) * sin(radians(latitude)))) AS distance_km"))
                 ->where("latitude", "!=", "")
                 ->where("longitude", "!=", "")
                 ->having("distance_km", "<", $distance)
                 ->orderBy("distance_km", "ASC")
                 ->get();
    }
}
