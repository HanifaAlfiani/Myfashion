@extends('layouts.front', ['web' => $web])
@section('container')
<style>
    .card {
        box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px !important;
        cursor: pointer;
        transition: 01s;
    }

    .card:hover {
        transform: scale(1.1);
    }
    h1 {
        font-weight: bold;
        font-style: 40px;
        text-align: center;
    }
    a {
        text-decoration: none;
    }
</style>
    <div class="row" style="margin-top: 50px;">
        <div class="col-sm-12">
            <h1 style="color: #232d68;">Temukan produk yang anda inginkan</h1>
        </div>
    </div>

    <div class="row" style="margin-top: 70px;">
        <div class="col-sm-4" style="padding: 30px;">
            <a href="{{ route('atasan.index') }}">
                <div class="card text-center" style="border: none; ">
                    <div class="card-body">
                        <img src="{{ asset('shirt.png') }}" width="140" style="padding: 15px;"><br>
                        <h6 class="mt-3" style="color: #232d68; font-weight: 100;">Atasan</button>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-4" style="padding: 30px;">
            <a href="{{ route('celana.index') }}">
                <div class="card text-center" style="border: none; ">
                    <div class="card-body">
                        <img src="{{ asset('trousers.png') }}" width="140" style="padding: 15px;"><br>
                        <h6 class="mt-3" style="color: #232d68; font-weight: 100;">Celana</button>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-4" style="padding: 30px;">
            <a href="{{ route('outer.index') }}">
            <div class="card text-center" style="border: none; ">
                <div class="card-body">
                    <img src="{{ asset('garment.png') }}" width="140" style="padding: 8px;">
                    <h6 class=" mt-3" style="color: #232d68;font-weight: 100;">Outer</button>
                </div>
            </div>
            </a>
        </div>
    </div>
    <br><br><br>
@endsection