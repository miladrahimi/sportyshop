<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\Tag;
use App\Services\TagManager;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        if ($q = $request->input('q')) {
            $products = Product::where('title', 'like', "%$q%")
                ->paginate(10);
        } else {
            $products = Product::paginate(10);
        }

        return view('admin.products.index', [
            'products' => $products,
        ]);
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $this->validateProduct($request);

        $product = Product::create([
            'title' => $request->input('title'),
            'price' => $request->input('price'),
            'content' => $request->input('content'),
        ]);

        $this->updateProductTags($product, $request->input('content'));

        return redirect()->route('admin.products.edit', $product);
    }

    public function edit(Product $product)
    {
        $attributeNames = ['count'];
        $attributeValues = [];
        foreach ($product->attributes as $attribute) {
            $value = [];

            foreach ($attribute->record as $a => $v) {
                if (in_array($a, $attributeNames) == false) {
                    array_push($attributeNames, $a);
                }

                $value[array_search($a, $attributeNames)] = $v;
            }

            $value[0] = $attribute->count;
            $attributeValues[] = $value;
        }

        return view('admin.products.edit', [
            'product' => $product,
            'attributeNames' => $attributeNames,
            'attributeValues' => $attributeValues,
        ]);
    }

    public function update(Product $product, Request $request)
    {
        $this->validateProduct($request);

        $product->update([
            'title' => $request->input('title'),
            'price' => $request->input('price'),
            'content' => $request->input('content'),
        ]);

        $this->updateProductTags($product, $request->input('content'));

        return back()->with('success', 'Updated.');
    }

    /**
     * @param Product $product
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function updateAttributes(Product $product, Request $request)
    {
        $request->validate([
            'names' => ['required'],
            'values' => ['required'],
        ]);

        $names = $request->input('names');
        $values = $request->input('values');

        if (in_array('count', $names) == false) {
            return new JsonResponse(['message' => 'The given data was invalid.'], 400);
        }

        $countIndex = array_search('count', $names);

        ProductAttribute::whereProductId($product->id)->delete();

        foreach ($values as $value) {
            $record = [];
            foreach ($value as $i => $v) {
                if ($i != $countIndex) {
                    $record[$names[$i]] = $v;
                }
            }

            ProductAttribute::create([
                'product_id' => $product->id,
                'count' => $value[$countIndex],
                'record' => json_encode($record),
            ]);
        }

        return new JsonResponse(['message' => 'ok']);
    }

    public function storePhoto(Product $product, Request $request)
    {
        $request->validate([
            'photo' => ['required', 'file', 'mimetypes:image/jpeg', 'max:512'],
        ]);

        $product->storePhoto($request->file('photo')->path());

        return new JsonResponse(['message' => 'ok']);
    }

    public function deletePhoto(Product $product, Request $request)
    {
        $request->validate([
            'url' => ['required', 'url'],
        ]);

        $url = $request->input('url');
        $nameStartChar = strrpos($url, '/');
        $name = substr($url, $nameStartChar + 1);

        $product->deletePhoto($name);

        return new JsonResponse(['message' => 'ok']);
    }

    /**
     * @param Product $product
     * @return RedirectResponse
     * @throws Exception
     */
    public function delete(Product $product)
    {
        $product->tags()->sync([]);
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', trans('e.deleted'));
    }

    private function validateProduct(Request $request)
    {
        $request->validate([
            'title' => ['required'],
            'price' => ['required', 'numeric', 'min:1000', 'max:10000000'],
            'content' => ['required'],
        ]);
    }

    private function updateProductTags(Product $product, string $content)
    {
        $tagManager = new TagManager();
        $tagNames = $tagManager->extract($content);

        $tags = [];
        foreach ($tagNames as $name) {
            $tags[] = Tag::firstOrCreate(['name' => $name]);
        }

        $product->tags()->sync(collect($tags)->pluck('id'));
    }
}
