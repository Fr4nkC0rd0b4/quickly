<?php

namespace App\Http\Controllers;

use App\Delivery;
use App\Delivery_details;
use Auth;
use Illuminate\Http\Request;

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

        return $deliveries;
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
        //dd($request->all());
        $user_id = Auth::user()->id;
        $delivery = new Delivery();

        /*$delivery->user_id = Auth::user()->id;
        $delivery->destination_city = $request->destination_city;
        $delivery->origin_city = $request->origin_city;
        $delivery->shipping_point = $request->shipping_point;
        $delivery->pick_up_point = $request->pick_up_point;
        $delivery->type = $request->type;
        $delivery->status = 0;
        $delivery->save();*/

        $delivery->fill($request->all());

        $result = $delivery->save();

        if ($result) {
            $delivery_id = Delivery::select('id')->where('user_id', $user_id)->get();
            $father_delivery = $delivery_id->last();

            $deliveri_details = new Delivery_details();

            $deliveri_details->fill($request->all());

            $deliveri_details->save();

            if ($deliveri_details) {
                return "Guardado el detalle";
            }
        }
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
    public function update(Request $request, Delivery $delivery)
    {
        //
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
}
