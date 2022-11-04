<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('id', 'ASC')->get();
        $response = [
          'message' => 'List Product',
          'data' => $products
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
              'code' => ['required', 'max:255'],
              'name' => ['required']
            ]);
  
            $products = Product::create([
              'code' => $request->code,
              'name' => $request->name,
            ]);
  
            $response = [
              'message' => 'Product successfully created',
              'data' => $products
            ];
  
            return response()->json($response, Response::HTTP_CREATED);
  
  
          } catch (QueryException $error) {
            return response()->json([
              'message' => 'Product unsuccesfully created',
              $error->errorInfo,
              Response::HTTP_UNPROCESSABLE_ENTITY
            ]);
          };
    }

    
}
