<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Student</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:sans-serif; background:#f3f4f6; min-height:100vh; }
        nav { background:#1f2937; padding:16px 32px; display:flex;
              justify-content:space-between; align-items:center; }
        nav .brand { color:white; font-size:18px; font-weight:700; }
        nav .links a { color:#d1d5db; text-decoration:none;
                       margin-left:24px; font-size:14px; }
        nav .links a:hover { color:white; }
        .logout-btn { background:#ef4444; color:white; border:none;
                      padding:8px 16px; border-radius:6px; cursor:pointer;
                      font-size:13px; margin-left:24px; }
        .container { max-width:520px; margin:40px auto; padding:0 20px; }
        .card { background:white; border-radius:16px; padding:36px;
                box-shadow:0 2px 12px rgba(0,0,0,0.06); margin-bottom:20px; }
        h1 { font-size:22px; font-weight:700; color:#1f2937; margin-bottom:6px; }
        p.sub { color:#6b7280; font-size:14px; margin-bottom:28px; }
        label { display:block; font-size:13px; font-weight:500;
                color:#374151; margin-bottom:6px; }
        input { width:100%; padding:10px 14px; border:1px solid #d1d5db;
                border-radius:8px; font-size:14px; margin-bottom:18px; outline:none; }
        input:focus { border-color:#6366f1; }
        button[type="submit"] { width:100%; padding:12px; background:#6366f1;
                 color:white; border:none; border-radius:8px;
                 font-size:15px; font-weight:600; cursor:pointer; }
        .error-msg { color:#dc2626; font-size:12px;
                     margin-top:-12px; margin-bottom:12px; }

        /* ── Credentials box shown after creation ── */
        .creds-box { background:#f0fdf4; border:1.5px solid #bbf7d0;
                     border-radius:14px; padding:28px 28px 22px; }
        .creds-box h2 { font-size:16px; font-weight:700; color:#15803d;
                        margin-bottom:4px; }
        .creds-box .hint { font-size:13px; color:#4ade80; margin-bottom:20px; }
        .cred-row { display:flex; justify-content:space-between;
                    align-items:center; background:white; border:1px solid #d1fae5;
                    border-radius:8px; padding:10px 14px; margin-bottom:10px; }
        .cred-row .key { font-size:12px; color:#6b7280; margin-bottom:2px; }
        .cred-row .val { font-size:15px; font-weight:600; color:#1f2937; }
        .copy-btn { background:#dcfce7; color:#16a34a; border:none;
                    padding:6px 12px; border-radius:6px; font-size:12px;
                    font-weight:600; cursor:pointer; }
        .copy-btn:active { background:#bbf7d0; }
        .login-link { display:block; text-align:center; margin-top:16px;
                      background:#6366f1; color:white; padding:12px;
                      border-radius:8px; text-decoration:none;
                      font-size:14px; font-weight:600; }
        .login-link:hover { background:#4f46e5; }
        .divider { text-align:center; font-size:12px; color:#9ca3af;
                   margin:10px 0; }
        .another-btn { display:block; text-align:center; color:#6366f1;
                       font-size:14px; text-decoration:none; font-weight:500; }
    </style>
</head>
<body>

<nav>
    <span class="brand">⚙️ Admin Panel</span>
    <div class="links">
        <a href="/admin/dashboard">All Counters</a>
        <a href="/admin/students">Students</a>
        <a href="/admin/students/create">+ New Student</a>
        <form method="POST" action="/logout" style="display:inline">
            @csrf
            <button class="logout-btn" type="submit">Logout</button>
        </form>
    </div>
</nav>

<div class="container">

    {{-- ✅ Show credentials AFTER student is created --}}
    @if(session('created_email'))
    <div class="creds-box">
        <h2>✅ Student account created!</h2>
        <p class="hint">Share these login details with the student.</p>

        <div class="cred-row">
            <div>
                <div class="key">Email</div>
                <div class="val" id="cred-email">{{ session('created_email') }}</div>
            </div>
            <button class="copy-btn" onclick="copyText('cred-email', this)">Copy</button>
        </div>

        <div class="cred-row">
            <div>
                <div class="key">Password</div>
                <div class="val" id="cred-pass">{{ session('created_password') }}</div>
            </div>
            <button class="copy-btn" onclick="copyText('cred-pass', this)">Copy</button>
        </div>

        <a href="/login" target="_blank" class="login-link">
            🔗 Open Student Login Page
        </a>
        <div class="divider">— or —</div>
        <a href="/admin/students/create" class="another-btn">+ Create another student</a>
    </div>

    @else
    {{-- ── Create student form ── --}}
    <div class="card">
        <h1>Create Student</h1>
        <p class="sub">Student can log in at <strong>/login</strong> with these credentials.</p>

        <form method="POST" action="/admin/students/create">
            @csrf

            <label>Full Name</label>
            <input type="text" name="name" value="{{ old('name') }}"
                   placeholder="John Doe" required>
            @error('name')<p class="error-msg">{{ $message }}</p>@enderror

            <label>Email Address</label>
            <input type="email" name="email" value="{{ old('email') }}"
                   placeholder="john@example.com" required>
            @error('email')<p class="error-msg">{{ $message }}</p>@enderror

            <label>Password</label>
            <input type="password" name="password"
                   placeholder="Min. 6 characters" required>
            @error('password')<p class="error-msg">{{ $message }}</p>@enderror

            <label>Confirm Password</label>
            <input type="password" name="password_confirmation"
                   placeholder="Repeat password" required>

            <button type="submit">Create Student</button>
        </form>
    </div>
    @endif

</div>

<script>
function copyText(id, btn) {
    const text = document.getElementById(id).innerText;
    navigator.clipboard.writeText(text).then(() => {
        btn.innerText = 'Copied!';
        setTimeout(() => btn.innerText = 'Copy', 2000);
    });
}
</script>

</body>
</html>