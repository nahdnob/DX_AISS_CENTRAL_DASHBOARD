<?php

namespace App\Http\Controllers;

//import model
use App\Models\ProductIn;
use App\Models\ProductSummary;
use App\Services\Production\SummaryService;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(
        private SummaryService $summaryService,
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = ProductSummary::with([
            'firstProductIn:id,part_number,time_in',
            'lastProductIn:id,product_out_id,part_number,time_in',
            'lastProductIn.productOut:id,tag_id,part_number,time_out',
        ]);

        if ($search) {
            $query->where('part_number', 'like', "%{$search}%");
        }

        $products = $query->paginate(10)->withQueryString();

        return view('products.index', compact('products'));
    }   

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}