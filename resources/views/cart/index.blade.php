@extends('layout.master')

@section('content')
<div>cart </div>
@if (!empty($CartProduct))
<?php $total = 0; $qty=0;?>
<table class="table table-head-fixed text-nowrap">
    <thead>
        <tr>
            <th>Nama Barang</th>
            <th>qty</th>
            <th>harga</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        
        @foreach ($CartProduct as $key => $CartProduct)
        <tr>
            
        <td>{{$CartProduct->product->name}}</td>
        <td>{{$CartProduct->qty}}</td>
        <td>{{$CartProduct->product->price * $CartProduct->qty}}</td>
        <td>
            <form action="{{ route('cart.store')}}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{$CartProduct->product->id}}">
                <button type="submit" class="btn btn-sm btn-outline-secondary">
                  <i class="fas fa-heart"></i> Tambah
                </button>
            </form>
            <form action="{{ route('cart.update', $CartProduct->id)}}" method="POST">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-sm btn-outline-secondary">
                  <i class="fas fa-heart"></i> kurang
                </button>
            </form>
            <form action="{{ route('cart.destroy', $CartProduct->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-secondary">
                  <i class="fas fa-heart"></i> hapus
                </button>
            </form>
        </td>
        </tr>
        <?php 
            $total += ($CartProduct->product->price * $CartProduct->qty) ;
            $qty += $CartProduct->qty;
        ?>
        @endforeach
        <tr>
            <td><b>Total</b></td>
            <td><b><?= $qty?></b></td>
            <td><b><?= $total?></b></td>
            <td>
                <form action="{{ route('order.store')}}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-secondary">
                      <i class="fas fa-heart"></i> checkout
                    </button>
                </form>
            </td>
        </tr>
    </tbody>
</table>
@else
@if(empty($CartProduct))
<p>tidak ada</p>
@endif
@endif


@endsection