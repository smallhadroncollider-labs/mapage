<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Message extends Model {
    protected $fillable = array('latitude', 'longitude', 'message');

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
        'message' => 'string',
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    protected static function getFromCoordinates($latitude, $longitude, $distance)
    {
        $earthRadiusKM = 6371;

        return static::select(DB::raw("*, ({$earthRadiusKM} * acos(cos(radians({$latitude})) * cos(radians(latitude)) * cos(radians({$longitude}) - radians(longitude)) + sin(radians({$latitude})) * sin(radians(latitude)))) AS distance_km"))
                 ->where("latitude", "!=", "")
                 ->where("longitude", "!=", "")
                 ->having("distance_km", "<", $distance)
                 ->orderBy("distance_km", "ASC")
                 ->with("user")
                 ->get();
    }
}
