@extends('layout.master2')

@section('content')
<div class="container">
        <div class="content-wrapper">
            <h2>List of Product</h2><br/>
            <a class="btn btn-success" href="{{ route('product.create')}}"> Add Product</a>
            <div class="row">
            <table class="table table-head-fixed text-nowrap">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Barang</th>
                        <th>Gambar</th>
                        <th>Harga</th>
                        <th>Stock</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($product as $key => $product)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{ $product->name}}</td>
                        <td><img src="{{ $product->gambar}}" class="rounded float-left" style="width: 150px"></td>
                        <td>{{$product->price}}</td>
                        <td>{{ $product->stock}}</td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('product.edit', $product->id) }}">Edit</a>
                            <button type="button" data-toggle="modal" data-target="#delete{{$product->id}}" class="btn btn-danger">Delete</button>    
                        </td>
                    </tr>
                    <div class="modal" id="delete{{$product->id}}" tabindex="-1">
                        <form action="{{ route('product.destroy', $product->id) }}" method="POST">
                            @csrf 
                            @method('DELETE')
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Delete Option</h5>
                                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>are you sure to delete this data?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" class="btn btn-primary">yes</button>
                                </div>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
</div>
@endsection