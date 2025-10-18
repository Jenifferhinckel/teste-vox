<!doctype html>
<html lang="en" data-bs-theme="auto">
  @include('header')
  <body class="d-flex align-items-center py-4 bg-body-tertiary h-100">
    <main class="form-signin w-100 m-auto p-4" style="max-width: 330px;">
    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif
      <form method="POST" action="{{ route('category.update', $category->id) }}">
        @csrf
        @method('PUT')
        <h2 class="h3 mb-3 fw-normal text-center">Editar categoria</h2>
        <div class="col-12 mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="" value="{{ $category->name }}" required>
        </div>
        <div class="d-flex justify-content-between">
            <a href="{{ route('kanban.index') }}" class="btn btn-secondary w-0 py-2 mt-2">voltar</a>
            <form class="delete-form-category" action="{{ route('category.destroy', $category->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger w-50 py-2 mt-2 mx-2 ">
                    <i class="bi bi-trash me-2"></i> Excluir
                </button>
            </form>
            <button class="btn btn-primary w-50 py-2 mt-2" type="submit">
            Editar
            </button>
        </div>
      </form>
    </main>
    @stack('scripts')
  </body>
</html>


