<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;

use App\Message;

use Illuminate\Http\Request;

class MessagesController extends Controller {
    public function __construct(Guard $auth) {
        parent::__construct($auth);
        $this->auth = $auth;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $longitude = (float) $request->input("longitude");
        $latitude = (float) $request->input("latitude");

        $messages = Message::getFromCoordinates($latitude, $longitude, 0.1);

        return $messages;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $user = $this->auth->user();

        if (!$user) {
            abort(401);
        }

        $message = new Message($request->only("longitude", "latitude", "message"));
        $message->user_id = $user->id;
        $message->save();
        return $message;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}
