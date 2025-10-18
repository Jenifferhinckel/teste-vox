<!doctype html>
<html lang="en" data-bs-theme="auto">
  @include('head')
  <body class="h-100">
    @include('header')
    <main class="form-signin w-100 m-auto p-4" style="max-width: 330px;">
    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif
      <form method="POST" action="{{ route('kanban.update', $board->id) }}">
        @csrf
        @method('PUT')
        <h2 class="h3 mb-3 fw-normal text-center">Editar quadro</h2>
        <div class="col-12 mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="" value="{{ $board->name }}" required>
        </div>
        <div class="col-12 mb-3">
            <label for="categoria" class="form-label">Categoria</label>
            <select class="form-select" id="category_id" name="category_id" required>
                <option value="">Escolha...</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if ($board->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="d-flex justify-content-between">
            <a href="{{ route('kanban.index') }}" class="btn btn-secondary w-0 py-2 mt-2">voltar</a>
            <button class="btn btn-primary w-50 py-2 mt-2" type="submit">
            Editar
            </button>
        </div>
      </form>
    </main>
  </body>
</html>
