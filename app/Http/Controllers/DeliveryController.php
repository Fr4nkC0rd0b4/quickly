<?php

namespace App\Http\Controllers;

use App\Delivery;
use App\DeliveryDetail;
use App\Traits\NotificationTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeliveryController extends Controller
{
    use NotificationTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

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

        foreach ($deliveries as $value) {
            $value->detail;
            $value->user;
            $value->date = $value->date();
        }

        return response()->json($deliveries);
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

        $this->sendNotification($delivery);
    }

    /**
     * Display the specified resource.
     *
     * @param  Int $id
     * @return JSON $delivery
     */
    public function show($id)
    {
        $delivery = Delivery::find($id);

        $delivery->detail;
        $delivery->user;

        $delivery->date = $delivery->date();

        return response()->json($delivery);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {


        /* if ($save) {
            $delivery = Delivery::find($delivery_detail->delivery_id);

            $delivery->delivery_man = Auth::user()->id;
            $delivery->status_id = 2;
            $delivery->save();

            $delivery->detail;
        } */
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
     * Set the offer shipping rate
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return JSON $response
     */
    public function offerShippingRate(Request $request)
    {
        $response = [];

        $delivery_detail = DeliveryDetail::find($request->id);

        $delivery_detail->final_offer = $request->offer;

        if ($delivery_detail->save()) {
            $response = [
                'message' => 'Oferta envíada con éxito.'
            ];
        } else {
            $response = [
                'message' => 'Error al envíar oferta.'
            ];
        }

        return response()->json($response, 200);
    }

    public function declineShippingRate(Request $request)
    {
        $delivery_detail = DeliveryDetail::find($request->id);

        $delivery_detail->final_offer = $delivery_detail->inital_offer;

        $delivery_detail->save();
    }
}
