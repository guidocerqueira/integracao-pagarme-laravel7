<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        return view('admin.products.index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        try {
            DB::beginTransaction();

            $productCreate = Product::create($request->all());

            DB::commit();
            return redirect()->route('admin.product.edit', [
                'product' => $productCreate->id
            ])->with([
                'color' => 'success',
                'message' => 'Produto cadastrado com sucesso!'
            ]);
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->withErrors([
                'message' => $e->getMessage()
            ]);
        }
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
        $product = Product::find($id);

        if (is_null($product)) {
            abort(404, 'Produto não encontrado!');
        }

        return view('admin.products.edit', [
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $product = Product::find($id);

        if (is_null($product)) {
            abort(404, 'Produto não encontrado!');
        }

        try {
            DB::beginTransaction();

            $product->fill($request->all());
            $product->save();

            DB::commit();
            return redirect()->route('admin.product.edit', [
                'product' => $product->id
            ])->with([
                'color' => 'success',
                'message' => 'Produto atualizado com sucesso!'
            ]);
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->withErrors([
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($product = Product::where('id', $id)->delete()) {
            $json['delete'] = true;
            $json['redirect'] = route('admin.product.index');
            $json['message'] = 'Produto removido com sucesso!';
            return response()->json($json);
        }

        $json['error'] = true;
        $json['message'] = 'Não foi possível excluir o produto. Favor, tente novamente!';
        return response()->json($json);
    }
}
