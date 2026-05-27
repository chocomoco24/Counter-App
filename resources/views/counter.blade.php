<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Counter App</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: sans-serif;
            background: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background: white;
            border-radius: 16px;
            padding: 48px 64px;
            text-align: center;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
        }

        h1 {
            font-size: 18px;
            color: #6b7280;
            margin-bottom: 24px;
            font-weight: 500;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .count {
            font-size: 96px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 32px;
            min-width: 180px;
            display: inline-block;
        }

        .count.positive { color: #16a34a; }
        .count.negative { color: #dc2626; }

        .buttons {
            display: flex;
            gap: 12px;
            justify-content: center;
            margin-bottom: 16px;
        }

        button {
            width: 64px;
            height: 64px;
            font-size: 28px;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            font-weight: 600;
            transition: transform 0.1s, opacity 0.1s;
        }

        button:active { transform: scale(0.93); opacity: 0.85; }

        .btn-dec  { background: #fee2e2; color: #dc2626; }
        .btn-inc  { background: #dcfce7; color: #16a34a; }
        .btn-reset {
            width: auto;
            padding: 10px 28px;
            border-radius: 8px;
            font-size: 14px;
            background: #f3f4f6;
            color: #6b7280;
        }

        .db-note {
            margin-top: 20px;
            font-size: 12px;
            color: #9ca3af;
        }
    </style>
</head>
<body>

<div class="card">
    <h1>Counter</h1>

    <div class="count {{ $counter->value > 0 ? 'positive' : ($counter->value < 0 ? 'negative' : '') }}">
        {{ $counter->value }}
    </div>

    <div class="buttons">
        {{-- Decrement button --}}
        <form action="/decrement" method="POST">
            @csrf
            <button class="btn-dec" type="submit">−</button>
        </form>

        {{-- Increment button --}}
        <form action="/increment" method="POST">
            @csrf
            <button class="btn-inc" type="submit">+</button>
        </form>
    </div>

    {{-- Reset button --}}
    <form action="/reset" method="POST">
        @csrf
        <button class="btn-reset" type="submit">Reset</button>
    </form>

    <p class="db-note">✅ Value saved in MySQL database</p>
</div>

</body>
</html>