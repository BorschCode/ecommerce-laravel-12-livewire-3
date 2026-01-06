<div>

    @section('metatags')
        <title>{{ config('app.name') . ' :: ' . ($title ?? 'Page Title') }}</title>
        <meta name="description" content="{{ $desc ?? 'default...' }}">
    @endsection

    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="breadcrumbs" id="products">
                    <ul>
                        <li><a href="{{ route('home') }}" wire:navigate>Home</a></li>
                        @foreach($breadcrumbs as $breadcrumb_slug => $breadcrumb_title)
                            @if($loop->last)
                                <li><span>{{ $breadcrumb_title }}</span></li>
                            @else
                                <li><a href="{{ route('category', $breadcrumb_slug) }}" wire:navigate>{{ $breadcrumb_title }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <div class="container position-relative">

        <div class="update-loading" wire:loading wire:target.except="add2Cart">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-4">
                <div class="sidebar">

                    <button class="btn btn-warning w-100 text-start collapse-filters-btn mb-3" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapseFilters" aria-expanded="false"
                            aria-controls="collapseExample">
                        <i class="fa-solid fa-filter"></i> Filters
                    </button>

                    <div class="collapse collapse-filters" id="collapseFilters">

                        @if($selected_filters)
                            <button class="btn btn-outline-warning w-100 mb-3" wire:click="clearFilters">Clear filters</button>

                            <div class="selected-filters mb-3">
                                @foreach($filter_groups as $filter_group)
                                    @foreach($filter_group as $filter)
                                        @if(in_array($filter->filter_id, $selected_filters))
                                            <p wire:click="removeFilter({{ $filter->filter_id }})" wire:key="{{ $filter->filter_id }}">
                                                <i class="fa-solid fa-xmark text-danger"></i> {{ $filter->filter_title }}
                                            </p>
                                        @endif
                                    @endforeach
                                @endforeach
                            </div>
                        @endif

                        <div class="filter-price">
                            <input type="number" class="form-control" wire:model.live.debounce.500ms="min_price" value="{{ $min_price }}">
                            <input type="number" class="form-control" wire:model.live.debounce.500ms="max_price" value="{{ $max_price }}">
                        </div>

                        @foreach($filter_groups as $k => $filter_group)
                            <div class="filter-block" wire:key="{{ $k }}">
                                <h5 class="section-title"><span>Filter by {{ $filter_group[0]->title }}</span></h5>

                                @foreach($filter_group as $filter)
                                <div class="form-check d-flex justify-content-between" wire:key="{{ $filter->filter_id }}">
                                        <div>
                                            <input
                                                wire:model.live="selected_filters"
                                                class="form-check-input"
                                                type="checkbox"
                                                value="{{ $filter->filter_id }}"
                                                id="filter-{{ $filter->filter_id }}">
                                            <label class="form-check-label" for="filter-{{ $filter->filter_id }}">
                                                {{ $filter->filter_title }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach

                    </div>


                </div>
            </div>

            <div class="col-lg-9 col-md-8">
                <div class="row mb-3">
                    <div class="col-12">
                        <h1 class="section-title h3"><span>{{ $category->title }}</span></h1>
                    </div>
                </div>

                @if(count($products))
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Sort By:</span>
                                <select class="form-select" aria-label="Sort by:" wire:change="changeSort" wire:model="sort">
                                    @foreach($sortList as $k => $item)
                                        <option value="{{ $k }}" @if($k == $sort) selected @endif wire:key="{{ $k }}">{{ $item['title'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Show:</span>
                                <select class="form-select" aria-label="Show:" wire:change="changeLimit" wire:model="limit">
                                    @foreach($limitList as $k => $item)
                                        <option @if($k == $limit) selected @endif wire:key="{{ $k }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        @foreach($products as $product)
                            <div class="col-lg-4 col-sm-6 mb-3" wire:key="{{ $product->id }}">
                                @include('incs.product-card')
                            </div>
                        @endforeach
                    </div>

                    <div class="row">
                        <div class="col-12">
                            {{ $products->links(data: ['scrollTo' => '#products']) }}
                        </div>
                    </div>
                @else
                    <p>No products found...</p>
                @endif

            </div>
        </div>
    </div>
</div>

@script
<script>

    $wire.on('page-updated', data => {
        // console.log(data);
        document.title = data.title;
    });

</script>
@endscript
