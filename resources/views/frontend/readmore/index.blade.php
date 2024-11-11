@extends('frontend.layout.master')

@section('content')
    <main>
        <section class="section">
            <div class="container">
                <div class="row no-gutters-lg">
                    <div class="col-12">
                        <h2 class="section-title">{{ $post->title }}</h2>
                    </div>
                    <div class="col-12 mb-5 mb-lg-0">
                        <div class="row d-flex " style="row-gap: 20px">
                            <div class="col-12">
                                <article class="card article-card">
                                    <div class="card-image">
                                        <div class="post-info"> <span
                                                class="text-uppercase">{{ $post->created_at->format('d
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            M Y') }}</span>
                                            <span
                                                class="text-uppercase">{{ round(Str::of($post->description)->wordCount() / 238, 2) }}
                                                minutes read</span>
                                        </div>
                                        <img loading="lazy" decoding="async"
                                            src="{{ asset('storage/images/post/' . $post->image->filename) }}"
                                            alt="Post Thumbnail" class="w-100">
                                    </div>
                                    <div class="card-body px-0 pb-1">
                                        <ul class="post-meta mb-2">
                                            <li>
                                                @foreach ($post->tags as $tag)
                                                    <p>{{ $tag->tag }}</p>
                                                @endforeach
                                            </li>
                                        </ul>
                                        <h2 class="h1">{{ $post->title }}</h2>
                                        <p class="card-text">{!! $post->description !!}</p>
                                        <div>
                                            <!-- Form to add a new comment -->
                                            <form action="{{ route('comments.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                                <textarea name="comment" class="form-control" placeholder="Leave a comment here"></textarea>
                                                <button type="submit" class="btn btn-success ms-auto d-block mt-3">
                                                    Comment</button>
                                            </form>
                                            <!-- Display comments and replies -->
                                            @if ($post && $post->comments->count() > 0)
                                                <h2 class="fs-5 fw-semibold">{{ $post->comments_count }} Comments</h2>
                                                <div style="max-height: 250px;overflow-y:scroll">
                                                    @foreach ($post->comments as $comment)
                                                        <div>
                                                            <div class="py-2 px-3 text-start fs-6 mb-3 w-100"
                                                                style="background-color: #F8F9FA">
                                                                <p class="fw-semibold mb-0 mark">{{ $comment->user->name }}
                                                                    <span
                                                                        class="text-sm fst-italic fw-lighter">({{ $comment->created_at->format('F j, Y') }})</span>
                                                                </p>
                                                                <p class="fw-normal mb-0">{{ $comment->comment }}</p>
                                                                <form action="{{ route('comment.delete', $comment->id) }}"
                                                                    method="POST" class="p-0 mt-0">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-transparent text-danger border-0 btn-sm p-0"
                                                                        onclick="return confirm('Are you sure you want to delete this comment?')">Delete</button>
                                                                </form>
                                                                <p class="fw-normal mb-0 text-success text-end reply-btn position-relative"
                                                                    style="cursor: pointer;z-index:2"
                                                                    data-comment-id="{{ $comment->id }}">Reply</p>
                                                                <form action="{{ route('comments.reply', $comment) }}"
                                                                    method="POST" class="reply-form"
                                                                    data-comment-id="{{ $comment->id }}"
                                                                    style="display: none;">
                                                                    @csrf
                                                                    <textarea name="comment" class="form-control" placeholder="Leave a comment here"></textarea>
                                                                    <button type="submit"
                                                                        class="btn btn-success ms-auto d-block mt-3">Reply</button>
                                                                </form>

                                                                <!-- Display Replies -->
                                                                @if ($comment->replies->count() > 0)
                                                                    <div style="position: relative;top:-20px">
                                                                        @foreach ($comment->replies as $reply)
                                                                            <div class="ps-3">
                                                                                <p class="fw-semibold mb-0">Reply <i
                                                                                        class="fa-solid fa-reply"></i></p>
                                                                                <div class="ps-3">
                                                                                    <p class="fw-semibold mb-0 highlight">
                                                                                        {{ $reply->user->name }} <span
                                                                                            class="text-sm fst-italic fw-lighter">({{ $reply->created_at->format('F j, Y') }})</span>
                                                                                    </p>
                                                                                    <p class="fw-normal mb-0">
                                                                                        {{ $reply->comment }}</p>
                                                                                    <form
                                                                                       action="{{ route('comment.delete.reply', ['id' => $reply->id, 'commentId' => $reply->comment_id]) }}"
                                                                                        method="POST" class="p-0 mt-0">
                                                                                        @csrf
                                                                                        @method('DELETE')
                                                                                        <button type="submit"
                                                                                            class="btn btn-transparent text-danger border-0 btn-sm p-0"
                                                                                            onclick="return confirm('Are you sure you want to delete this comment?')">Delete</button>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                </article>
                            </div>
                            {{-- recommended --}}
                            <div class="col-12">
                                <h2>Recommended</h2>
                            </div>
                            @foreach ($recommendedPosts as $post)
                                <div class="col-md-4  ">
                                    <article class="card article-card article-card-sm h-100">
                                        <a href="{{ route('frontend.read-more', $post->id) }}">
                                            <div class="card-image">
                                                <div class="post-info"> <span
                                                        class="text-uppercase">{{ $post->created_at->format('d M Y') }}</span>
                                                    <span
                                                        class="text-uppercase">{{ round(Str::of($post->description)->wordCount() / 238, 2) }}
                                                        minutes read</span>
                                                </div>
                                                <img loading="lazy" decoding="async"
                                                    src="{{ asset('storage/images/post/' . $post->image->filename) }}"
                                                    alt="Post Thumbnail" class="w-100">
                                            </div>
                                        </a>
                                        <div class="card-body px-0 pb-0">
                                            <ul class="post-meta mb-2">

                                                <li>
                                                    @foreach ($post->tags as $tag)
                                                        <a
                                                            href="{{ route('frontend.read-more', $post->id) }}">{{ $tag->tag }}</a>
                                                    @endforeach
                                                </li>
                                            </ul>
                                            <h2><a class="post-title"
                                                    href="{{ route('frontend.read-more', $post->id) }}">{{ $post->title }}</a>
                                            </h2>
                                            <p class="card-text">{!! Str::limit($post->description, 200) !!}</p>
                                            <div class="content"> <a class="read-more-btn"
                                                    href="{{ route('frontend.read-more', $post->id) }}">Read
                                                    Full
                                                    Articles</a>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const replyButtons = document.querySelectorAll('.reply-btn');

            replyButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const commentId = this.getAttribute('data-comment-id');
                    const replyForm = document.querySelector(
                        `.reply-form[data-comment-id='${commentId}']`);

                    if (replyForm.style.display === 'block') {
                        replyForm.style.display = 'none';
                        this.textContent = 'Reply';
                    } else {
                        document.querySelectorAll('.reply-form').forEach(form => {
                            form.style.display = 'none';
                        });
                        document.querySelectorAll('.reply-btn').forEach(btn => {
                            btn.textContent = 'Reply';
                        });

                        replyForm.style.display = 'block';
                        this.textContent = 'Hide';
                    }
                });
            });
        });
    </script>
@endpush
