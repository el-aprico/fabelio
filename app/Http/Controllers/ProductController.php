<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Repositories\Interfaces\MonitorRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Goutte\Client;

class ProductController extends Controller
{

    private $productRepo;
    private $monitorRepo;

    public function __construct(ProductRepositoryInterface $productRepo, MonitorRepositoryInterface $monitorRepo)
    {
        $this->productRepo = $productRepo;
        $this->monitorRepo = $monitorRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $args = [
            'products' => $this->productRepo->getAll()
        ];
        return view('product.index', $args);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($date = '')
    {
        $product = $this->productRepo;
        return view('product.create', compact('product', 'date'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $this->productRepo->create($request->toArray());
        return redirect()->route('product.index')
            ->with('success', 'Product Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param  \App\ProductRequest  $question
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->productRepo->getById($id);
        $images = json_decode($product->image);
        return view('product.show', compact('product', 'images'));
    }

}
