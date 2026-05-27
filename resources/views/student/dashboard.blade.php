<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Counters</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: sans-serif;
            background: #f3f4f6;
            min-height: 100vh;
        }

        nav {
            background: #6366f1;
            padding: 16px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav .brand {
            color: white;
            font-size: 18px;
            font-weight: 700;
        }

        nav .user {
            color: #c7d2fe;
            font-size: 14px;
        }

        .logout-btn {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            margin-left: 16px;
        }

        .container {
            max-width: 960px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
        }

        h1 {
            font-size: 24px;
            font-weight: 700;
            color: #1f2937;
        }

        .new-btn {
            background: #6366f1;
            color: white;
            border: none;
            padding: 10px 22px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 20px;
        }

        .card {
            background: white;
            border-radius: 16px;
            padding: 28px 20px;
            text-align: center;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
        }

        .card-label {
            font-size: 12px;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: .5px;
            margin-bottom: 10px;
        }

        .count {
            font-size: 64px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .positive {
            color: #16a34a;
        }

        .negative {
            color: #dc2626;
        }

        .zero {
            color: #6b7280;
        }

        .btns {
            display: flex;
            gap: 8px;
            justify-content: center;
            margin-bottom: 12px;
        }

        .btn {
            width: 44px;
            height: 44px;
            border: none;
            border-radius: 50%;
            font-size: 22px;
            font-weight: 700;
            cursor: pointer;
        }

        .btn-dec {
            background: #fee2e2;
            color: #dc2626;
        }

        .btn-inc {
            background: #dcfce7;
            color: #16a34a;
        }

        .btn-reset {
            width: 100%;
            padding: 8px;
            border: none;
            border-radius: 8px;
            background: #f3f4f6;
            color: #6b7280;
            font-size: 13px;
            cursor: pointer;
            margin-bottom: 8px;
        }

        .btn-del {
            width: 100%;
            padding: 8px;
            border: none;
            border-radius: 8px;
            background: #fee2e2;
            color: #dc2626;
            font-size: 13px;
            cursor: pointer;
        }

        .success {
            background: #dcfce7;
            color: #16a34a;
            padding: 12px 18px;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .empty {
            text-align: center;
            padding: 60px 20px;
            color: #9ca3af;
            font-size: 16px;
        }
    </style>
</head>

<body>

    <nav>
        <span class="brand">🎛️ My Counters</span>
        <div style="display:flex; align-items:center;">
            <span class="user">{{ auth()->user()->name }}</span>
            <form method="POST" action="/logout" style="display:inline">
                @csrf
                <button class="logout-btn" type="submit">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        <div class="top">
            <h1>My Counters</h1>
            <form method="POST" action="/student/counters">
                @csrf
                <button class="new-btn" type="submit">+ New Counter</button>
            </form>
        </div>

        @if($counters->isEmpty())
            <div class="empty">No counters yet. Hit "+ New Counter" to create one!</div>
        @else
            <div class="grid">
                @foreach($counters as $counter)
                    <div class="card">
                        <p class="card-label">Counter #{{ $counter->id }}</p>
                        <div class="count {{ $counter->value > 0 ? 'positive' : ($counter->value < 0 ? 'negative' : 'zero') }}">
                            {{ $counter->value }}
                        </div>

                        <div class="btns">
                            <form method="POST" action="/student/counters/{{ $counter->id }}/decrement">
                                @csrf
                                <button class="btn btn-dec" type="submit">−</button>
                            </form>
                            <form method="POST" action="/student/counters/{{ $counter->id }}/increment">
                                @csrf
                                <button class="btn btn-inc" type="submit">+</button>
                            </form>
                        </div>

                        <form method="POST" action="/student/counters/{{ $counter->id }}/reset">
                            @csrf
                            <button class="btn-reset" type="submit">Reset</button>
                        </form>

                        <form method="POST" action="/student/counters/{{ $counter->id }}"
                            onsubmit="return confirm('Delete this counter?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn-del" type="submit">Delete</button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</body>

</html>