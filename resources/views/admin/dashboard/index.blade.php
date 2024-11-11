@extends('admin.layouts.master')
@section('content')
<div class="d-flex justify-content-center justify-content-md-between  align-items-center" style="row -gap: 20px;flex-wrap:wrap">

    <div class="card d-flex align-items-center justify-content-center " style="width: 18rem;background-color: #1CAD9E;">
        <div class="card-body py-4 text-white text-center">
            <i class="fa-solid fa-briefcase fs-1"></i>
            <p class="fs-5 pt-2 mb-0">{{$postCount}}</p>
            <p class="fs-4">Posts</p>
        </div>
    </div>

    <div class="card d-flex align-items-center justify-content-center" style="width: 18rem;background-color: #DC3745;">
        <div class="card-body py-4 text-white text-center">
            <i class="fa-solid fa-tag fs-1"></i>
            <p class="fs-5 pt-2 mb-0">{{$tagsCount}}</p>
            <p class="fs-4">Tags</p>
        </div>
    </div>

    <div class="card d-flex align-items-center justify-content-center" style="width: 18rem;background-color: #0864C7;">
        <div class="card-body py-4 text-white text-center">
            <i class="fa-solid fa-layer-group fs-1"></i>
            <p class="fs-5 pt-2 mb-0">{{$categoryCount}}</p>
            <p class="fs-4 ">Categories</p>
        </div>
    </div>

    <div class="card d-flex align-items-center justify-content-center"
        style="width: 18rem;background-color: #61412ACF;">
        <div class="card-body py-4 text-white text-center">
            <i class="fa-solid fa-users fs-1"></i>
            <p class="fs-5 pt-2 mb-0">{{$userCount}} </p>
            <p class="fs-4 ">Users</p>
        </div>
    </div>
</div>
@endsection
