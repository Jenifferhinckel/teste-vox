<!doctype html>
<html lang="en" data-bs-theme="auto">
  @include('head')
  <body class="h-100">
    @include('header')
    <main class="form-signin w-100 m-auto p-4" style="max-width: 330px;">
    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif
      <form method="POST" action="{{ route('kanban.store') }}">
        @csrf
        <h2 class="h3 mb-3 fw-normal text-center">Cadastrar quadro</h2>
        <div class="col-12 mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="" value="" required>
        </div>
        <div class="col-12 mb-3">
            <label for="categoria" class="form-label">Categoria</label>
            <select class="form-select" id="category_id" name="category_id" required>
                <option value="">Escolha...</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="d-flex justify-content-between">
            <a href="{{ route('kanban.index') }}" class="btn btn-secondary w-0 py-2 mt-2">voltar</a>
            <button class="btn btn-primary w-50 py-2 mt-2" type="submit">
            Cadastrar
            </button>
        </div>
      </form>
    </main>
  </body>
</html>
