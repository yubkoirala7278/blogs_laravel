@extends('admin.layouts.master')

@section('content')
    <div class="bg-white p-4 w-100">
        <div class="d-flex align-items-center justify-content-between">
            <h2 class="fs-5 mb-3 fw-bold">Posts</h2>
            <a href="{{ route('posts.create') }}" class="text-success  fs-4"><i class="fa-solid fa-circle-plus"></i></a>
        </div>
        <div style="overflow-x: scroll">
            <table class="table table-bordered "  >
                <thead>
                    <tr>
                        <th scope="col">S.N</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Category</th>
                        <th scope="col">Username</th>
                        <th scope="col">Status</th>
                        <th scope="col">Tags</th>
                        <th scope="col">Image</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $key => $post)
                        <tr>
                            <th>{{ $key + 1 }}</th>
                            <td>{{ Str::limit($post->title, 15) }}</td>
                            <td>{!! Str::limit($post->description, 15) !!}</td>
                            <td>{{ !empty($post->category) ? $post->category->category : '' }}</td>
                            <td>{{ $post->user->name }}</td>
                            <td>{{ $post->status == 1 ? 'Active' : 'Inactive' }}</td>
                            <td>
                                @if (count($post->tags) > 0)
                                    @foreach ($post->tags as $tag)
                                        <p>{{ $tag->tag }}</p>
                                    @endforeach
                                @endif
    
                            </td>
                            <td>
                                <img src="{{ asset('storage/images/post/' . $post->image->filename) }}" alt=""
                                    style="height: 20px">
                            </td>
                            <td>
                                <div class="d-flex align-items-center" style="gap: 10px">
                                    <a href="{{ route('posts.show', $post->id) }}" class="text-primary"><i
                                            class="fa-regular fa-eye"></i></a>
                                    <a href="{{ route('posts.edit', $post->id) }}" class="text-warning"><i
                                            class="fa-solid fa-pencil"></i></a>
                                    <form action="{{ route('posts.destroy', $post) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-transparent text-danger p-0 show-alert-delete-box"
                                            data-toggle="tooltip" title='Delete'><i
                                                class="fa-regular fa-trash-can"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $posts->links() !!}
        </div>
       
    </div>
@endsection
