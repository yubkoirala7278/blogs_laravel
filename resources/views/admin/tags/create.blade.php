@extends('admin.layouts.master')

@section('content')
    <div class="bg-white p-4">
        <h2 class="fs-5 mb-4 fw-bold">Create Tag</h2>
        <form action="{{route('tag.store')}}" method="POST">
            @csrf
            {{-- tag --}}
            <div class="mb-3">
                <label for="tag" class="form-label">Tag</label>
                <input type="text" class="form-control" id="tag" name="tag" placeholder="tag"
                    value="{{ old('tag') }}">
                @if ($errors->has('tag'))
                    <span class="text-danger text-sm">{{ $errors->first('tag') }}</span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection