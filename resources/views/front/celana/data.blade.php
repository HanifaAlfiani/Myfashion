@extends('layouts.front', ['web' => $web])
@section('container')
<style>
    .card {
        box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px !important;
        cursor: pointer;
        transition: 01s;
    }

    
    h1 {
        font-weight: bold;
        font-style: 10px;
        text-align: left;
    }

    a {
        text-decoration: none;
    }
</style>
<div class="row" style="margin-top: 50px;">
    <div class="col-sm-12 text-center">
        <h5 style="color: #232d68;">Celana</h3>
        <img src="{{ asset('trousers.png') }}" width="100" style="padding: 15px;"><br>
    </div>
</div>

<div class="row" style="margin-top: 80px;">
    @foreach($celana as $celanaAll)
        <div class="col-sm-4" style="padding: 30px;">
            <a href="{{ $celanaAll->link }}">
                <div class="card" style="border: none;">
                    <img src="{{ Storage::url($celanaAll->gambar) }}" class="card-img-top" alt="Placeholder" style="width: 100%; height: 280px; object-fit: cover;">
                    <div class="card-body">
                        <h6 class="card-title" style="color: #232d68;">{{ Str::limit($celanaAll->nama, 60) }}</h6>
                        <p class="card-text text-muted">{{ $celanaAll->harga }}</p>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>
<br>
<div class="d-flex justify-content-center">
    {{ $celana->links('vendor.pagination.front_custom_pagination') }}
</div> 
<br>
@endsection