<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\MethodOfPayment;
use App\Movement;
use App\Sale;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::where('stock','>',0)->get();
        // dd($products);
        $methods_of_payment = MethodOfPayment::all();
		return view('products.sales.create',compact('products','methods_of_payment'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sale = new Sale(request()->all());
        // dd(request()->all());
        $products = $request->get('products_id');
        $quantity = $request->get('td_quantity');
        $cont = 0;
        while ( $cont < count($products) ) {
            $sale->save(); 
            $data_products = explode("_",$products[$cont]);
            $p = Product::findOrFail($data_products[0]);
            $p->stock=(int)$p->stock - (int)$quantity[$cont];
            $p->update();
            // dd($data_products);
            $sale->products()->attach($data_products[0],['quantity' => $quantity[$cont], 'price' => $data_products[4]]);
            $cont = $cont+1;
        }
        $movement= new Movement();
        $movement->concept= " VENTA DE PRODUCTOS N° ".$sale->id;
        $movement->type="INGRESO";
        $movement->method_of_payment_id = $sale->method_of_payment_id;
        $movement->amount = $request->get("total");
        $movement->save();
        return redirect('movements')->with('info','Venta registrada con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
