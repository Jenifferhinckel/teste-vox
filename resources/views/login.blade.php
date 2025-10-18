<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body class="d-flex align-items-center py-4 bg-body-tertiary h-100">
    <main class="form-signin w-100 m-auto p-4" style="max-width: 330px;">
    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif
      <form method="POST" action="{{ route('login.post') }}">
        @csrf
        <img
          class="mb-4 img-fluid mx-auto d-block"
          src="{{ asset('images/logo.png') }}"
          alt=""
          width="100"
          height="90"
        />
        <h2 class="h3 mb-3 fw-normal">Login</h2>
        <div class="form-floating">
          <input
            type="email"
            class="form-control mb-2"
            id="email"
            name="email"
            placeholder="name@example.com"
            required
          />
          <label for="floatingInput">Email</label>
        </div>
        <div class="form-floating">
          <input
            type="password"
            class="form-control"
            id="password"
            name="password"
            placeholder="Password"
            required
          />
          <label for="floatingPassword">Senha</label>
        </div>
        <button class="btn btn-primary w-100 py-2 mt-2" type="submit">
          Entrar
        </button>
        <p class="mt-5 mb-3 text-body-secondary text-center">&copy; 2025 Jeniffer Hinckel.</p>
      </form>
    </main>
  </body>
</html>
