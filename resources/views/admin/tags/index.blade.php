@extends('admin.layouts.master')
@section('content')
    <div class="bg-white p-4">
        <div class="d-flex align-items-center justify-content-between">
            <h2 class="fs-5 mb-3 fw-bold">Tags</h2>
            <a href="{{route('tag.create')}}" class="text-success  fs-4"><i class="fa-solid fa-circle-plus"></i></a>
        </div>
        <div style="overflow-x: scroll">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">SN</th>
                        <th scope="col">Title</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($tags) > 0)
                        @foreach ($tags as $key => $tag)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $tag->tag }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a href="{{route('tag.edit',$tag->id)}}" class="text-warning"><i class="fa-solid fa-pencil"></i></a>
                                        <form action="{{ route('tag.destroy', $tag->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-transparent text-danger show-alert-delete-box" data-toggle="tooltip" title='Delete'><i
                                                    class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3" class="text-center">No data to display</td>
                        </tr>
                    @endif
    
    
                </tbody>
            </table>
        </div>
       
    </div>
@endsection
