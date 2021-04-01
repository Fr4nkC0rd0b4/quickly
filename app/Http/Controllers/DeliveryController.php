<?php

namespace App\Http\Controllers;

use App\Delivery;
use App\DeliveryDetail;
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
        //dd($request->all());
        $user_id = Auth::user()->id;
        $delivery = new Delivery();

        $delivery->user_id = $user_id;
        $delivery->fill($request->all());
        $result = $delivery->save();

        if ($result) {
            $delivery_id = Delivery::select('id')->where('user_id', $user_id)->get();
            $delivery_father = $delivery_id->last();

            $detail = new DeliveryDetail();

            $detail->delivery_id = $delivery_father->id;
            $detail->final_offer = $request->initial_offer;
            $detail->fill($request->all());
            $detail->save();
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
    public function update(Request $request)
    {
        $delivery_detail = DeliveryDetail::find($request->id);
        $delivery_detail->final_offer = $request->final_offer;
        $save = $delivery_detail->save();

        if ($save) {
            $delivery = Delivery::find($delivery_detail->delivery_id);

            $delivery->delivery_man = Auth::user()->id;
            $delivery->status = 1;
            $delivery->save();
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
}
