<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <title>YouTube Scraper</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background: #f5f6fa;
        }

        .top-box {
            background: #fff;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }

        textarea {
            resize: none;
            border-radius: 10px;
        }

        .btn-main {
            background: #c44536;
            color: #fff;
            border-radius: 10px;
            padding: 10px 20px;
        }

        .filter-btn {
            border-radius: 20px;
            padding: 5px 15px;
            background: #eee;
            margin-left: 5px;
            cursor: pointer;
        }

        .filter-btn.active {
            background: #c44536;
            color: #fff;
        }

        .course-card {
            border-radius: 15px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: 0.3s;
        }

        .course-card:hover {
            transform: translateY(-5px);
        }

        .card-img {
            height: 150px;
            background: #ddd;
        }

        .badge-top {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #c44536;
            color: #fff;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
        }

        .meta {
            font-size: 12px;
            color: #777;
        }

        .tag {
            background: #f1dede;
            color: #c44536;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 12px;
        }

        .pagination {
            gap: 5px;
        }

        .page-link {
            border-radius: 8px !important;
            border: none;
            color: #333;
        }

        .page-item.active .page-link {
            background: #c44536;
            border: none;
            color: #fff;
        }

        .page-link:hover {
            background: #eee;
        }
    </style>
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
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $playlists->links() }}
    </div>

</body>

</html>
