<?php

namespace App\Http\Controllers;

use Auth;
use App\Delivery;
use App\DeliveryDetail;
use App\User;
use App\Events\NotificationsPushEvent;
use App\Notifications\EventNotifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $role = Auth::user()->role->name;
        $id = Auth::user()->id;

        switch ($role) {
            case 'user':
                $deliveries = Delivery::where('user_id', $id)->search($request->searching)->orderBy('id', 'DESC')->paginate(10);
                break;
            case 'quicker':
                $deliveries = Delivery::search($request->searching)->orderBy('id', 'DESC')->paginate(10);
                break;

            default:
                $deliveries = Delivery::search($request->searching)->orderBy('id', 'DESC')->paginate(10);
                break;
        }

        foreach ($deliveries as $key => $value) {
            $value->detail;
            $value->user;
        }

        return response()->json($deliveries);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;

        $delivery = new Delivery();

        $delivery->user_id = $user_id;
        $delivery->fill($request->all());
        $result = $delivery->save();

        if ($result) {
            $delivery_id = $delivery->id;

            $detail = new DeliveryDetail();

            $detail->delivery_id = $delivery_id;
            $detail->final_offer = $request->initial_offer;
            $detail->fill($request->all());
            $detail->save();
        }

        $this->setNotification($delivery->id, $delivery->user_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function show(Delivery $delivery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function edit(Delivery $delivery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $delivery_detail = DeliveryDetail::find($request->id);
        $delivery_detail->final_offer = $request->final_offer;
        $save = $delivery_detail->save();

        if ($save) {
            $delivery = Delivery::find($delivery_detail->delivery_id);

            $delivery->delivery_man = Auth::user()->id;
            $delivery->status_id = 2;
            $delivery->save();

            $delivery->detail;
            // dd($delivery);
            event(new NotificationsPushEvent($delivery));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Delivery $delivery)
    {
        //
    }

    /**
     * Store the specified resource from storage.
     *
     * @param  Int  $record_id
     * @return Illuminate\Support\Facades\Notification
     */
    private function setNotification($record_id, $user_id)
    {
        $esquema = Delivery::all();

        $notification = [
            'title'     => 'Nueva solicitud de envio.',
            'record_id' => $record_id,
            'user_id'   => $user_id,
        ];

        Notification::send($esquema, new EventNotifications($notification));
    }
}
