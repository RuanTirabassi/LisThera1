<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | LisThera</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <style>
    body { display: flex; align-items: center; justify-content: center; min-height: 100dvh; background: var(--bg, #f7f6f2); }
    .login-box {
      background: #fff; border: 1px solid var(--border, #dcd9d5);
      border-radius: 18px; padding: 40px 36px; width: 100%; max-width: 400px;
      display: flex; flex-direction: column; gap: 24px;
    }
    .login-brand { display: flex; align-items: center; gap: 12px; }
    .login-brand-mark {
      width: 40px; height: 40px; border-radius: 12px;
      background: #01696f; color: #fff;
      display: flex; align-items: center; justify-content: center;
      font-weight: 700; font-size: 1.2rem;
    }
    .login-brand strong { font-size: 1.1rem; display: block; }
    .login-brand span { font-size: .82rem; color: #7a7974; }
    .login-title { font-size: 1.3rem; font-weight: 700; }
    .login-form { display: flex; flex-direction: column; gap: 14px; }
    .login-field { display: flex; flex-direction: column; gap: 6px; }
    .login-field label { font-size: .88rem; font-weight: 600; }
    .login-field input {
      padding: 11px 14px; border: 1px solid #dcd9d5;
      border-radius: 10px; font-size: .95rem; width: 100%;
      font-family: inherit;
    }
    .login-field input:focus { outline: 2px solid #01696f; outline-offset: 2px; }
    .login-btn {
      padding: 12px; background: #01696f; color: #fff;
      border: none; border-radius: 10px; font-weight: 600;
      font-size: .95rem; cursor: pointer; font-family: inherit;
      margin-top: 4px;
    }
    .login-btn:hover { background: #0c4e54; }
    .login-error {
      background: #fce8e8; color: #a12c2c;
      border-radius: 10px; padding: 10px 14px; font-size: .88rem;
    }
  </style>
</head>
<body>
  <div class="login-box">
    <div class="login-brand">
      <div class="login-brand-mark">L</div>
      <div><strong>LisThera</strong><span>Protótipo TCC</span></div>
    </div>
    <h1 class="login-title">Entrar no sistema</h1>

    @if ($errors->any())
      <div class="login-error">{{ $errors->first('email') }}</div>
    @endif

    <form class="login-form" method="POST" action="{{ url('/login') }}">
      @csrf
      <div class="login-field">
        <label for="email">E-mail</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="seu@email.com" required autofocus>
      </div>
      <div class="login-field">
        <label for="password">Senha</label>
        <input id="password" type="password" name="password" placeholder="Sua senha" required>
      </div>
      <button type="submit" class="login-btn">Entrar</button>
    </form>
  </div>
</body>
</html>
