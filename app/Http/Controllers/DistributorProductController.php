<?php

namespace App\Http\Controllers;

use App\Models\DistributorProduct;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DistributorProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $distributorpro = DistributorProduct::with(['product', 'distributor'])
                              ->orderBy('id', 'ASC')
                              ->get();
        $response = [
          'message' => 'List Product',
          'data' => $distributorpro
        ];

        return response()->json($response, Response::HTTP_OK);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
              'product_id' => ['required', 'exists:products,id'],
              'distributor_id' => ['required', 'exists:distributors,id'],
              'price' => ['numeric']
            ]);
  
            $distributorpro = DistributorProduct::create([
              'product_id' => $request->product_id,
              'distributor_id' => $request->distributor_id,
              'price' => $request->price
            ]);

            $listdistributor = DistributorProduct::with(['product', 'distributor'])
                              ->where('id', $distributorpro->id,)
                              ->orderBy('id', 'ASC')
                              ->first();
  
            $response = [
              'message' => 'Distributor successfully created',
              'data' => $listdistributor
            ];
  
            return response()->json($response, Response::HTTP_CREATED);
  
  
          } catch (QueryException $error) {
            return response()->json([
              'message' => 'Distributor unsuccesfully created',
              $error->errorInfo,
              Response::HTTP_UNPROCESSABLE_ENTITY
            ]);
          };
    }

    
}
