<div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="breadcrumbs">
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><a href="#">Shop</a></li>
                        <li><span>Category Name</span></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4">
                <div class="sidebar">

                    <button class="btn btn-warning w-100 text-start collapse-filters-btn mb-3" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapseFilters" aria-expanded="false"
                            aria-controls="collapseExample">
                        <i class="fa-solid fa-filter"></i> Filters
                    </button>

                    <div class="collapse collapse-filters" id="collapseFilters">
                        <div class="filter-block">
                            <h5 class="section-title"><span>Filter by color</span></h5>
                            <form action="">
                                <div class="form-check d-flex justify-content-between">
                                    <div>
                                        <input class="form-check-input" type="checkbox" value="" id="black">
                                        <label class="form-check-label" for="black">
                                            Black
                                        </label>
                                    </div>
                                </div>
                                <div class="form-check d-flex justify-content-between">
                                    <div>
                                        <input class="form-check-input" type="checkbox" value="" id="white">
                                        <label class="form-check-label" for="white">
                                            White
                                        </label>
                                    </div>
                                </div>
                                <div class="form-check d-flex justify-content-between">
                                    <div>
                                        <input class="form-check-input" type="checkbox" value="" id="red">
                                        <label class="form-check-label" for="red">
                                            Red
                                        </label>
                                    </div>
                                </div>
                                <div class="form-check d-flex justify-content-between">
                                    <div>
                                        <input class="form-check-input" type="checkbox" value="" id="blue">
                                        <label class="form-check-label" for="blue">
                                            Blue
                                        </label>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="filter-block">
                            <h5 class="section-title">
                                <span>Filter by size</span>
                            </h5>

                            <form action="">
                                <div class="form-check d-flex justify-content-between">
                                    <div>
                                        <input class="form-check-input" type="checkbox" value="" id="xs">
                                        <label class="form-check-label" for="xs">
                                            XS
                                        </label>
                                    </div>
                                </div>
                                <div class="form-check d-flex justify-content-between">
                                    <div>
                                        <input class="form-check-input" type="checkbox" value="" id="s">
                                        <label class="form-check-label" for="s">
                                            S
                                        </label>
                                    </div>
                                </div>
                                <div class="form-check d-flex justify-content-between">
                                    <div>
                                        <input class="form-check-input" type="checkbox" value="" id="m">
                                        <label class="form-check-label" for="m">
                                            M
                                        </label>
                                    </div>
                                </div>
                                <div class="form-check d-flex justify-content-between">
                                    <div>
                                        <input class="form-check-input" type="checkbox" value="" id="l">
                                        <label class="form-check-label" for="l">
                                            L
                                        </label>
                                    </div>
                                </div>
                                <div class="form-check d-flex justify-content-between">
                                    <div>
                                        <input class="form-check-input" type="checkbox" value="" id="xl">
                                        <label class="form-check-label" for="xl">
                                            XL
                                        </label>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="filter-block">
                            <h5 class="section-title">
                                <span>Filter by type</span>
                            </h5>

                            <form action="">
                                <div class="form-check d-flex justify-content-between">
                                    <div>
                                        <input class="form-check-input" type="checkbox" value="" id="man">
                                        <label class="form-check-label" for="man">
                                            Man
                                        </label>
                                    </div>
                                </div>
                                <div class="form-check d-flex justify-content-between">
                                    <div>
                                        <input class="form-check-input" type="checkbox" value="" id="woman">
                                        <label class="form-check-label" for="woman">
                                            Woman
                                        </label>
                                    </div>
                                </div>
                                <div class="form-check d-flex justify-content-between">
                                    <div>
                                        <input class="form-check-input" type="checkbox" value="" id="baby">
                                        <label class="form-check-label" for="baby">
                                            Baby
                                        </label>
                                    </div>
                                </div>
                            </form>
                        </div>
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
                                <select class="form-select" aria-label="Sort by:">
                                    <option selected>Default</option>
                                    <option value="1">Name (a-z)</option>
                                    <option value="2">Name (z-a)</option>
                                    <option value="3">Price (low &gt; high)</option>
                                    <option value="4">Price (high &gt; low)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Show:</span>
                                <select class="form-select" aria-label="Show:">
                                    <option selected>9</option>
                                    <option value="15">15</option>
                                    <option value="30">30</option>
                                    <option value="45">45</option>
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
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item active" aria-current="page"><a class="page-link"
                                                                                        href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                @else
                    <p>No products found...</p>
                @endif

            </div>
        </div>
    </div>
</div>
