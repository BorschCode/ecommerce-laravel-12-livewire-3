<?php

namespace App\Livewire\Search;

use Livewire\Component;

class SearchFormComponent extends Component
{

    public string $term = '';

    public function render()
    {
        return view('livewire.search.search-form-component');
    }
}
