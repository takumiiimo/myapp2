@extends('layouts.app')
@include('navbar')
@include('footer')

@section('content')
<div class="profile-wrap">
    <div class="row">
        <div class="col-md-4 text-center">
            @if($user->profile_photo)
                <p>
                    <img class="round-img" src="{{ secure_asset('storage/user_images/' . $user->profile_photo) }}"/>
                </p>
            @else
                <img class="round-img" src="{{ secure_asset('/images/blank_profile.png') }}"/>
            @endif
        </div>
        <div class="col-md-8">
            <div class="row">
                
                <h4>{{ $user->name }}</h4>
                
                @if ($user->id == Auth::user()->id)
                    <a class="btn btn-outline-dark common-btn edit-profile-btn" href="/users/edit">プロフィールを編集</a>
                    <a class="btn btn-outline-dark common-btn edit-profile-btn" rel="nofollow" data-method="POST" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                @endif
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">設定</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="list-group text-center">
                                <a class="list-group-item list-group-item-action" rel="nofollow" data-method="POST" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                                <a class="list-group-item list-group-item-action" data-dismiss="modal" href="#">キャンセル</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="introduction">
                <p>{{ $user->gender }}</p>
                <p>{{ $user->role }}</p>
                <p>{{ $user->aria }}</p>
                <p>{{ $user->introduction }}</p>
            </div>
            @foreach($posts as $post)
            <div class="album py-5 bg-light">
                <div class="container">
                    <div class="row">
                        <div class="card md-4">
                            <div class="card mb-4 shadow-sm">
                                <img class="card-img-top" src="/storage/post_images/{{ $post->id }}.jpg"  />
                                <div class="card-body">
                                    <p>{{ $post -> caption }}</p>
                                </div>
                            </div>
                        </div>
                    </div>    
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection