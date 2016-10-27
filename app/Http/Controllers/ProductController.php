<?php

namespace App\Http\Controllers;

use App\Company;
use App\Product;
use App\Tag;
use Exception;
use Illuminate\Http\Request;

use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller {

    public function __construct() {
        $this->middleware('manage_companies.edit', ['only' => ['create', 'store', 'edit', 'update', 'destroy']]);
        $this->middleware('manage_companies.view', ['only' => ['index']]);
        $this->middleware('manage_companies.show', ['only' => ['show']]);
    }

    public function index(Company $company) {

        $products = $company->products;

        return view('product.index')->with('products', $products)->with('company', $company);

    }

    public function create(Company $company) {
        return view('product.create')->with('company', $company);
    }

    public function store(ProductRequest $request, Company $company) {

        $data = $request->except(['_token', 'edit', 'file', 'tags']);
        $data['company_id'] = $company->id;

        try {
            $folder = 'companies/' . $company->id;
            $path = $request->file('image')->store($folder);
            $data['image'] = $path;

            $product = Product::create($data);

            $tags = explode(',', $request['tags']);

            foreach($tags as $_tag) {
                $tag = Tag::create([
                    'name' => $_tag
                ]);

                DB::table('product_tag')->insert([
                    'tag_id' => $tag->id,
                    'product_id' => $product->id,
                    'created_at' => date('Y-m-d H:i'),
                    'updated_at' => date('Y-m-d H:i')
                ]);
            }
        }
        catch(Exception $e) {
            $error = Config::get('constants.ERROR_MESSAGE');
            //$error = $e->getMessage();

            return back()->withInput($request->except('_token'))->with('error', $error);
        }

        $message = 'The product was successfully uploaded.';

        return redirect('companies/' . $company->id . '/products')->with('message', $message);

    }

    public function show(Company $company, Product $product) {
        return view('product.show')->with('company', $company)->with('product', $product);
    }

    public function edit(Company $company, Product $product) {
        return view('product.edit')->with('company', $company)->with('product', $product);
    }

    public function update(ProductRequest $request, Company $company, Product $product) {

        $data = $request->except('_token', 'edit', 'file', 'tags', 'product_id');

        try {
            if($request['image'] != null) {
                Storage::delete($product->image);

                $path = $request->file('image')->store('companies/' . $company->id);
                $data['image'] = $path;
            }

            if($request['tags'] != $product->implodedTags()) {
                foreach($product->tags as $tag) {
                    $tag->delete();
                }

                $tags = explode(',', $request['tags']);

                foreach($tags as $_tag) {
                    $tag = Tag::create([
                        'name' => $_tag
                    ]);

                    DB::table('product_tag')->insert([
                        'tag_id' => $tag->id,
                        'product_id' => $product->id,
                        'created_at' => date('Y-m-d H:i'),
                        'updated_at' => date('Y-m-d H:i')
                    ]);
                }
            }

            $product->update($data);
        }
        catch(Exception $e) {
            $error = Config::get('constants.ERROR_MESSAGE');
            //$error = $e->getMessage();

            return back()->withInput($request->except('_token'))->with('error', $error);
        }

        $message = 'Product <strong>' . $product->title . '</strong> was successfully updated.';

        return redirect('companies/' . $company->id . '/products')->with('message', $message);

    }

    public function destroy(Company $company, Product $product) {

        try {
            // Delete from product_tag
            // Delete tags
            Storage::delete($product->image);

            $product->delete();
        }
        catch(Exception $e) {
            $error = Config::get('constants.ERROR_MESSAGE');
            //$error = $e->getMessage();

            return redirect('companies/' . $company->id . '/products')->with('error', $error);
        }

        $message = 'Product <strong>' . $product->title . '</strong> was successfully removed.';

        return redirect('companies/' . $company->id . '/products')->with('message', $message);

    }

}
