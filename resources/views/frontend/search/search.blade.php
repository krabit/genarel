@extends('frontend.layouts.fashion')
@section('title')
    Trang tìm kiếm
@endsection

@section('content')

<div class="sub-banner my-banner2">
</div>
<div class="content">
    <div class="container">
        <div class="col-md-12 col-sm-12 women-dresses">

            @if(($results->count()) < 1)
            <h2>No result{{$results->count()}} </h2>
            @endif
            <?php $i=0; ?>
                <div class="women-set1">
            @foreach($results as $products)
                <?php
                    if(($i % 3) == 0){
                 ?>
                    <div class="clearfix"></div>
                </div>
                <div class="women-set{{$i}}">
                <?php
                }
                ?>
                    <?php
                    $images = (isset($products->images) && $products->images) ? json_decode($products->images): array();
                    ?>

                    <div class="col-md-4 women-grids wp1 animated wow slideInUp" data-wow-delay=".5s">
                        <a href="{{url('shop/product/'.$products->id)}}"><div class="product-img">
                                <?php if (count($images)) : ?>
                                @foreach($images as $image)
                                    <img src="{{asset($image)}}" alt="" />
                                    @break
                                @endforeach
                                <?php endif; ?>
                                <div class="p-mask">
                                    <form action="<?php echo url('shop/cart/add')?>" method="post">
                                        @csrf
                                        <input type="hidden" name="cmd" value="_cart" />
                                        <input type="hidden" name="add" value="1" />
                                        <input type="hidden" name="w3ls1_item" value="{{$products->id}}" />
                                        <input type="hidden" name="amount" value="{{$products->priceSale}}" />
                                        <button type="submit" class="w3ls-cart pw3ls-cart"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to cart</button>
                                    </form>
                                </div>
                            </div></a>
                        <i class="fa fa-star yellow-star" aria-hidden="true"></i>
                        <i class="fa fa-star yellow-star" aria-hidden="true"></i>
                        <i class="fa fa-star yellow-star" aria-hidden="true"></i>
                        <i class="fa fa-star yellow-star" aria-hidden="true"></i>
                        <i class="fa fa-star gray-star" aria-hidden="true"></i>
                        <h4>{{$products->name}}</h4>
                        <h5>VND{{$products->priceSale}}</h5>
                    </div>
                <?php $i++ ?>
            @endforeach
                </div>
                <div class="clearfix"></div>
            {{$results->links()}}

        </div>
    </div>
</div>
@endsection
