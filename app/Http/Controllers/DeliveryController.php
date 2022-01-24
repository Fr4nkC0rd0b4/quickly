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
            case 'admin':
                $deliveries = Delivery::search($request->searching)->orderBy('id', 'DESC')->paginate(10);
                break;

            case 'quicklero':
                $deliveries = Delivery::search($request->searching)->orderBy('id', 'DESC')->paginate(10);
                break;

            default:
                $deliveries = Delivery::where('user_id', $id)->search($request->searching)->orderBy('id', 'DESC')->paginate(10);
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
        $response = [];

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

            $response = [
                'status' => 'success',
                'message' => 'Solicitud registrada con éxtio.'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Error al registrar solicitud, por favor intente mas tarde.'
            ];
        }

        return response()->json($response, 200);
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
        $response = [];

        $delivery = Delivery::find($request->id);

        if ($delivery->status == 1) {
            $delivery->fill($request->all());
            if ($delivery->save()) {
                $response = [
                    'status' => 'success',
                    'message' => 'Solicitud actualizada.'
                ];
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'Ha ocurrido un error al actualizar su solicitud.'
                ];
            }
        } else {
            $response = [
                'status' => 'info',
                'message' => 'No es posible modificar la solicitud una vez ha sido aceptada por un Quicklero.'
            ];
        }

        return response()->json($response, 200);
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

        $delivery_detail = Delivery::find($request->id)->detail;

        $delivery_detail->final_offer = $request->offer;

        if ($delivery_detail->save()) {
            $response = [
                'status' => 'success',
                'message' => 'Oferta envíada con éxito.'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Error al envíar oferta.'
            ];
        }

        return response()->json($response, 200);
    }

    /**
     * Decline offer rate, set the final_offer value to initial_offer
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return JSON $response
     */
    public function declineShippingRate(Request $request)
    {
        $delivery_detail = Delivery::find($request->id)->detail;

        $delivery_detail->final_offer = $delivery_detail->inital_offer;

        if ($delivery_detail->save()) {
            $response = [
                'status' => 'success',
                'message' => 'Se declinó la oferta.'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Error al declinar oferta, si el problema persiste por favor contacte a soporte.'
            ];
        }

        return response()->json($response, 200);
    }
}
