@extends('admin.layouts.master')

@section('content')
    <div class="bg-white p-4">
        <h2 class="fs-5 mb-4 fw-bold">Edit Tag</h2>
        <form action="{{route('tag.update',$tag)}}" method="POST">
            @csrf
            @method('PUT')
            {{-- tag  --}}
            <div class="mb-3">
                <label for="tag" class="form-label">tag</label>
                <input type="text" class="form-control" id="tag" name="tag" placeholder="tag"
                    value="{{old('tag', $tag->tag)}}">
                @if ($errors->has('tag'))
                    <span class="text-danger text-sm">{{ $errors->first('tag') }}</span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection

