<?php

namespace App\Livewire\Product;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class CategoryComponent extends Component
{

    public string $slug = '';

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function render()
    {
        $category = Category::query()->where('slug', '=', $this->slug)->firstOrFail();
        $ids = \App\Helpers\Category\Category::getIds($category->id) . $category->id;

        $products = Product::query()
            ->whereIn('category_id', explode(',', $ids))
            ->orderBy('id', 'desc')
            ->paginate(3);

        return view('livewire.product.category-component', [
            'products' => $products,
            'category' => $category,
        ]);
    }
}
