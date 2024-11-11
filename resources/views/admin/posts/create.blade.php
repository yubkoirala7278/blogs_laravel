@extends('admin.layouts.master')

@section('content')
    <div class="bg-white p-4">
        <h2 class="fs-5 mb-4 fw-bold">Create Post</h2>
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- title --}}
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Title"
                    value="{{ old('title') }}">
                @if ($errors->has('title'))
                    <span class="text-danger text-sm">{{ $errors->first('title') }}</span>
                @endif
            </div>
            {{-- description --}}
            <div class="form-group mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="blog-content" placeholder="Enter the Description" rows="5" name="description"></textarea>
                @if ($errors->has('description'))
                    <span class="text-danger text-sm">{{ $errors->first('description') }}</span>
                @endif
            </div>
            {{-- Status (static single select) --}}
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" name="status" id="status">
                    <option selected disabled value="">Choose Option</option>
                    <option value="1">Publish</option>
                    <option value="0">Draft</option>
                </select>
                @if ($errors->has('status'))
                    <span class="text-danger text-sm">{{ $errors->first('status') }}</span>
                @endif
            </div>
            {{-- Category (dynamic single select) --}}
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" name="category" id="category">
                    <option selected disabled value="">Choose Category</option>
                    @if (count($categories) > 0)
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category }}</option>
                        @endforeach
                    @endif
                </select>
                @if ($errors->has('category'))
                    <span class="text-danger text-sm">{{ $errors->first('category') }}</span>
                @endif
            </div>
            {{-- image --}}
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" name="image">
                @if ($errors->has('image'))
                    <span class="text-danger">{{ $errors->first('image') }}</span>
                @endif

            </div>
            {{-- Tags (dynamic multiple select) --}}
            <div class="mb-3">
                <label for="tags" class="form-label">Tags</label>
                <select class="form-select" id="select-tags" data-placeholder="Choose Tags" multiple name="tags[]">
                    @if (count($tags) > 0)
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->tag }}</option>
                        @endforeach
                    @endif
                </select>
                @if ($errors->has('tags'))
                    <span class="text-danger text-sm">{{ $errors->first('tags') }}</span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            // multiple select fields
            $('#select-tags').select2({
                theme: "bootstrap-5", // Use "bs5" for Bootstrap 5
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                    'style',
                placeholder: $(this).data('placeholder'),
                closeOnSelect: false,
                tags: true
            });
            //  ck editor
            ClassicEditor
                .create(document.querySelector('#blog-content'), {
                    removePlugins: ['Image', 'ImageCaption', 'ImageStyle', 'ImageToolbar', 'ImageUpload',
                        'Indent', 'ImageUpload', 'MediaEmbed'
                    ],
                })
                // .then(editor => {
                //     console.log('Available plugins:', ClassicEditor.builtinPlugins.map(plugin => plugin
                //         .pluginName));
                // })
                .catch(error => {
                    console.error(error.stack);
                });

        });
    </script>
@endpush
