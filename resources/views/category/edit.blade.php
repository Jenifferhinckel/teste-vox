<!doctype html>
<html lang="en" data-bs-theme="auto">
  @include('head')
  <body class="h-100">
    @include('header')
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
            <button type="button" id="delete-form-category" class="btn btn-danger w-50 py-2 mt-2 mx-2 delete-form-category">
                <i class="bi bi-trash me-2"></i> Excluir
            </button>
            <button class="btn btn-primary w-50 py-2 mt-2" type="submit">
            Editar
            </button>
        </div>
      </form>
    </main>
    @stack('scripts')
  </body>
</html>
<script>
    document.querySelectorAll('.delete-form-category').forEach(button => {
        button.addEventListener('click', handleDeleteCategory);
    });

    function handleDeleteCategory(event) {
        Swal.fire({
            title: 'Tem certeza que deseja excluir esta categoria?',
            text: "Esta ação não pode ser desfeita!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sim, excluir!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('category.destroy', $category->id) }}",
                    type: 'POST',
                    data: {
                        _method: 'DELETE',
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        window.location.href = "{{ route('kanban.index') }}";
                    },
                    error: function(xhr) {
                        toastr.error('Erro ao excluir a categoria.', 'Erro');
                    }
                });
            }
        });
    }
</script>

