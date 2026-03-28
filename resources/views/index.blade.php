<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <title>YouTube Scraper</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/style.css') }}" rel="stylesheet">

</head>

<body class="container py-4">

    <!-- Top Section -->
    <div class="top-box mb-4">
        <form method="POST" action="{{ route('fetch') }}">
            @csrf

            <label class="mb-2">أدخل التصنيفات (كل تصنيف في سطر جديد)</label>

            <textarea name="categories" class="form-control mb-3" rows="5" placeholder="التسويق&#10;البرمجة&#10;الجرافيكس"></textarea>

            <button class="btn btn-main">ابدأ الجمع ▶</button>
        </form>
    </div>

    <!-- Filters -->
    <div class="mb-4 d-flex flex-wrap gap-2">

        <a href="{{ url('/') }}" class="filter-btn {{ request('category') ? '' : 'active' }}">
            الكل
        </a>

        @foreach ($categories as $cat)
            <a href="{{ url('/?category=' . $cat) }}"
                class="filter-btn {{ request('category') == $cat ? 'active' : '' }}">
                {{ $cat }}
            </a>
        @endforeach

    </div>

    <!-- Cards -->
    <div class="row">
        @foreach ($playlists as $p)
            <div class="col-md-3 mb-4">
                <a href="https://www.youtube.com/playlist?list={{ $p->playlist_id }}" class="text-decoration-none text-dark" target="_blank">
                    <div class="course-card position-relative">
                        <span class="badge-top">
                            {{ $p->lessons_count ?? 1 }} درس
                        </span>
                        <img src="{{ $p->thumbnail }}" class="w-100 card-img">

                        <div class="p-3">
                            <h6 class="mb-2">{{ $p->title }}</h6>

                            <div class="meta mb-2">
                                {{ $p->channel_name }}
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <span class="tag">{{ $p->category }}</span>
                            </div>
                        </div>

                    </div>
                </a>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $playlists->links() }}
    </div>

</body>

</html>
