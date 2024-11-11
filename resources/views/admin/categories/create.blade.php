@extends('admin.layouts.master')

@section('content')
    <div class="bg-white p-4">
        <h2 class="fs-5 mb-4 fw-bold">Create Category</h2>
        <form action="{{route('category.store')}}" method="POST">
            @csrf
            {{-- category --}}
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <input type="text" class="form-control" id="category" name="category" placeholder="Category"
                    value="{{ old('category') }}">
                @if ($errors->has('category'))
                    <span class="text-danger text-sm">{{ $errors->first('category') }}</span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection

