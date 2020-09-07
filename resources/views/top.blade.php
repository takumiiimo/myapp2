@extends('layouts.app')
@include('navbar')
@include('footer')

@section('content')
<div class="container">
    <div class="row">
        <div class="d-flex">
            <a class="creator" href="/creator">
                <div class="img_wrap">
                    <div class="imgEff">
                        <img src="/images/creator.jpg">
                    </div>
                </div>
            </a>
            <a class="model" href="/model">
                <div class="img_wrap">
                    <div class="imgEffmo"> 
                        <img src="/images/model.jpg">
                    </div>
                </div>
            </a> 
        </div>
    </div>
</div>    

@endsection
