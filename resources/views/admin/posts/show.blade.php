@extends('admin.layouts.master')
@section('content')
    <div class="bg-white p-4">
        <h2 class="fs-5 fw-bold mb-3">View Post</h2>
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th scope="col">Title</th>
                    <td>{{ $post->title }}</td>
                </tr>
                <tr>
                    <th scope="col">Description</th>
                    <td>{{ $post->description, 15 }}</td>
                </tr>
                <tr>
                    <th scope="col">Category</th>
                    <td>{{ $post->category->category }}</td>
                </tr>
                <tr>
                    <th scope="col">Username</th>
                    <td>{{ $post->user->name }}</td>
                </tr>
                <tr>
                    <th scope="col">Status</th>
                    <td>{{ $post->status == 1 ? 'Active' : 'Inactive' }}</td>
                </tr>
                <tr>
                    <th scope="col">Tags</th>
                    <td>
                        @if (count($post->tags) > 0)
                            @foreach ($post->tags as $tag)
                                <p>{{ $tag->tag }}</p>
                            @endforeach
                        @endif

                    </td>
                </tr>
                <tr>
                    <th scope="col">Image</th>
                    <td>
                        <img src="{{asset('storage/images/post/'.$post->image->filename)}}" alt="" style="height: 50px">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
