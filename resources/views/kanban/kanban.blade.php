<!DOCTYPE html>
<html lang="pt-br">
@include('head')
<body>
@include('header')
<div class="container mt-5">
    {{-- <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('category.create') }}" class="btn btn-primary mb-4">Criar categoria</a>
        <a href="{{ route('kanban.create') }}" class="btn btn-primary mb-4">Criar quadro</a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Sair</button>
        </form>
    </div> --}}
    @if($success = session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                toastr.success('{{ $success }}', 'Sucesso', {
                    closeButton: true,
                    progressBar: true,
                    timeOut: 5000
                });
            });
        </script>
    @endif
    <h1 class="text-center mb-4">Kanban</h1>

    <div class="kanban-container d-flex" style="overflow-x: auto;gap: 1rem;padding-bottom: 10px;height: 600px;overflow-y: auto;">
        @forelse ($categories as $category)
            <div class="kanban-column bg-light p-3 rounded shadow-sm" style="min-width: 300px;" id="{{ $category->id }}" data-category="{{ $category->id }}">
                <h5 class="text-center">
                    <a href="{{ route('category.edit', $category->id) }}" class="text-decoration-underline text-dark">
                        {{ $category->name }}
                    </a>
                </h5>

                @foreach ($board->where('category_id', $category->id)->sortBy('position') as $item)
                    <div class="card mb-2 kanban-item" data-id="{{ $item->id }}" id="item-{{ $item->id }}">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <span>{{ $item->name }}</span>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a href="{{ route('kanban.edit', $item->id) }}" class="dropdown-item">
                                            <i class="bi bi-pencil me-2"></i> Editar
                                        </a>
                                    </li>
                                    <li>
                                        <form class="delete-form" action="{{ route('kanban.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="bi bi-trash me-2"></i> Excluir
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @empty
            <p class="text-center">Não há nenhum registro.</p>
        @endforelse
    </div>
</div>
</body>
@include('footer')
<script>
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
        e.preventDefault();
            Swal.fire({
                title: "Tem certeza que deseja excluir?",
                icon: "warning",
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Sim",
                showDenyButton: true,
                denyButtonText: "Cancelar"
                }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    $(".kanban-column").sortable({
        connectWith: ".kanban-column",
        placeholder: "ui-state-highlight",
        items: ".kanban-item",
        stop: function(event, ui) {
            let id = ui.item.data('id');
            let column = ui.item.closest(".kanban-column");
            let newCategory = column.data("category");
            let positions = [];

            column.children(".kanban-item").each(function(index) {
                positions[index] = $(this).data("id");
            });

            $.ajax({
                url: "{{ route('kanban.updatePosition') }}",
                method: "PUT",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                    positions: positions,
                    category_id: newCategory
                },
                success: function(response) {
                    toastr.success(response.message, 'Sucesso');
                },
                error: function(xhr) {
                    toastr.error('Erro ao atualizar os itens.', 'Erro');
                }
            });
        },
        receive: function(event, ui) {
            $(this).trigger('update');
        }
    }).disableSelection();
</script>
</html>
