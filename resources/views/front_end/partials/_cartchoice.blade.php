
@foreach ($recentProducts as $product)
    <div class="modal fade" id="productSizeModal{{ $product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                @if (
                    $product->productsizes->where('itemsizes', '!=', null)->count() > 0 &&
                        $product->productsizes->where('itemcolors', '!=', null)->count() > 0)
                    <form action="{{ route('front.add_to_cart', $product->id) }}" method="post">
                        @csrf
                        <input type="hidden" name="selection_type" value="both">

                        <div class="modal-body">
                            <!-- Display product name and color -->
                            <h4>{{ $product->name }}</h4>
                            {{-- <h4>{{ $product->supplier_id }}</h4> --}}


                            <!-- Display size information -->
                            <h4>Sizes:</h4>
                            @foreach ($product->productsizes as $productsize)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="selected_sizes[]"
                                        value="{{ $productsize->id }}" id="size{{ $productsize->id }}">
                                    <label class="form-check-label" for="size{{ $productsize->id }}">
                                        {{ $productsize->itemsizes }} - Sh
                                        {{ number_format($productsize->itemprice, 2) }}
                                        <br><code>{{ $productsize->unities }} Units Remaining !!!</code>
                                    </label>

                                    <!-- Add color checkboxes for each size -->
                                    <x-product_color1 :itemcolorsCsv="$productsize->itemcolors" sizeId="{{ $productsize->id }}" />
                                </div>
                                <br>
                            @endforeach
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-primary" type="submit">Add To Cart</button>
                        </div>
                    </form>
                @elseif ($product->productsizes->where('itemsizes', '!=', null)->count() > 0)
                    <form action="{{ route('front.add_to_cart', $product->id) }}" method="post">
                        @csrf
                        <input type="hidden" name="selection_type" value="size">

                        <div class="modal-body">
                            <!-- Display product name and color -->
                            <h4>{{ $product->name }}</h4>

                            <!-- Display size information -->
                            <h4>Sizes:</h4>
                            @foreach ($product->productsizes as $productsize)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="selected_sizes[]"
                                        value="{{ $productsize->id }}" id="size{{ $productsize->id }}">
                                    <label class="form-check-label" for="size{{ $productsize->id }}">
                                        {{ $productsize->itemsizes }} - Sh
                                        {{ number_format($productsize->itemprice, 2) }}
                                        <br><code>{{ $productsize->unities }} Unities !!!</code>
                                    </label>
                                </div>
                                <br>
                            @endforeach

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-primary" type="submit">Add To Cart</button>
                        </div>
                    </form>
                @elseif ($product->colors)
                    <form action="{{ route('front.add_to_cart', $product->id) }}" method="post">
                        @csrf
                        <input type="hidden" name="selection_type" value="color">
                        {{-- <input type="hidden" name="supplier_id" value="{{ $product->supplier_id }}"> --}}

                        <div class="modal-body">
                            <!-- Display product name and color -->
                            <h4>{{ $product->name }}</h4><br>
                            <h6><strong class="text-primary"> Choose Your Best Color</strong></h6>
                            <div class="flex_wrap">

                                <x-product_color :colorsCsv="$product->colors" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-primary" type="submit">Add To Cart</button>
                        </div>
                    </form>
                @else
                    <form action="{{ route('front.add_to_cart', $product->id) }}" method="post">
                        @csrf

                        <input type="hidden" name="selection_type" value="none">

                        <h6><i class="text-primary">Add the product to the cart. Thank you !!!</i></h6>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-primary" type="submit">Add To Cart</button>
                        </div>

                    </form>
                @endif

            </div>
        </div>
    </div>
@endforeach
