@extends('layouts.customer.app')

@section('title', 'My Wishlist')

@section('styles')
<style>
    .wishlist-clear button {
        border: medium none;
        cursor: pointer;
        padding: 10px 30px;
        -webkit-transition: all 0.3s ease 0s;
        -o-transition: all 0.3s ease 0s;
        transition: all 0.3s ease 0s;
    }

    .wishlist-clear button:hover {
        background-color: #ff2f2f;
        color: #fff;
    }
</style>
@endsection

@section('content')
<div class="breadcrumb-area bg-gray">
            <div class="container">
                <div class="breadcrumb-content text-center">
                    <ul>
                        <li>
                            <a href="{{route('index')}}">Home</a>
                        </li>
                        <li class="active">Wishlist </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="cart-main-area pt-115 pb-120">
            <div class="container">
                <h3 class="cart-page-title">Your wishlist items</h3>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <form action="#">
                            <div class="table-content table-responsive cart-table-content">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Product Name</th>
                                            <th>Unite Price</th>
                                            <th>action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="wishlist-products">
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="wishlist-clear mt-3">
                    <button id="clear-wishlist">Clear Wishlist</button>
                </div>
            </div>
        </div>
@include('includes.customer.footer')
@endsection


@section('scripts')
<script>
    const $wishlistProducts = $('#wishlist-products');
    const products = JSON.parse(localStorage.getItem('products'));

    if(products !== null){
        products.forEach(function(item){
            $wishlistProducts.append(`
                <tr>
                    <td class="product-thumbnail">
                        <a href="#"><img style="height: 90px" src="${item.image}" alt="product image"></a>
                    </td>
                    <td class="product-name"><a href="#">${item.name}</a></td>
                    <td class="product-price-cart"><span class="amount">$${item.unitPrice}</span></td>
                    <td class="product-wishlist-cart">
                        <a href="javascript:void(0)" data-id="${item.id}" class="add-to-shoppingcart">add to cart</a>
                    </td>
                </tr>
            `);
        });
    }

    // Add from wishlist to shopping cart
    $('.add-to-shoppingcart').one('click', function () {
        console.log($(this).data('id'))
        $.ajax({
            url : '{{route("addToShoppingCart")}}',
            type: 'POST',
            data : { "product_id" : $(this).data('id'), quantity : 1, "_token" : "{{ csrf_token() }}" },
            success: function(respose, textStatus, xhr){
                $('.shooping-cart-count').each(function(index, counter){
                    counter.textContent = Number(counter.textContent) + 1;
                });
            },
            error : function(respose){
                console.log(respose)
            }
        });
    });


    // clear wishlist
    $('#clear-wishlist').click(function(){
        localStorage.clear();
        $wishlistProducts.text("");
        $('.wishlist-count').text('0');
    });
</script>
@endsection