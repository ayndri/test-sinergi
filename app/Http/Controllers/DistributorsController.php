<?php

namespace App\Http\Controllers;

use App\Models\Distributor;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DistributorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $distributors = Distributor::orderBy('id', 'ASC')->get();
        $response = [
          'message' => 'List Product',
          'data' => $distributors
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
              'code' => ['required', 'max:255'],
              'name' => ['required'],
              'address' => ['required']
            ]);
  
            $distributor = Distributor::create([
              'code' => $request->code,
              'name' => $request->name,
              'address' => $request->address
            ]);
  
            $response = [
              'message' => 'Distributor successfully created',
              'data' => $distributor
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
