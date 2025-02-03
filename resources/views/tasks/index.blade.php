<x-app-layout>
  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>
    <div class="py-12 bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container mt-5 bg-white">
                    <div class="row">
                        
                        <div class="col-md-12 m-5 p-5">
                            <h2>Criar Nova Categoria</h2>
                            <form method="POST" action="{{ route('category.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Nome</label>
                                    <input type="text" name="name" id="name" class="form-control" required>
                                </div>
                        
                                <button type="submit" class="btn btn-success mt-3">Criar Categoria</button>
                            </form>
                        </div>                        
                          <!-- Formulário de Criação de Tarefa -->
                        <div class="col-md-12 m-5  p-5">
                            <h2>Criar Nova Tarefa</h2>
                            <form method="POST" action="{{ route('tasks.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="title">Título</label>
                                    <input type="text" name="title" id="title" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="description">Descrição</label>
                                    <textarea name="description" id="description" class="form-control" required></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="category_id">Categoria</label>
                                    <select name="category_id" id="category_id" class="form-control" required>
                                        <option value="">Selecione a Categoria</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="0">Pendente</option>
                                        <option value="1">Em Progresso</option>
                                        <option value="2">Concluída</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="availability">Disponibilidade</label>
                                    <select name="availability" id="availability" class="form-control" required>
                                        <option value="0">Aguardando</option>
                                        <option value="1">Em Progresso</option>
                                        <option value="2">Pausada</option>
                                        <option value="3">Terminada</option>
                                    </select>
                                </div>
                                

                                <button type="submit" class="btn btn-success mt-3">Criar Tarefa</button>
                            </form>
                        </div>                       
                        <!-- Formulário de Filtro -->
                        <div class="col-md-12 m-5 p-5">
                            <h2 class="mb-4">Filtrar Tarefas</h2>
                            <form method="GET" action="{{ route('tasks.index') }}" class="form-inline mb-4">
                                <div class="form-group mr-2">
                                    <select name="category" class="form-control">
                                        <option value="">Selecione a Categoria</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mr-2">
                                    <select name="order_by" class="form-control">
                                        <option value="asc" {{ request('order_by') == 'asc' ? 'selected' : '' }}>Data de Criação: Ascendente </option>
                                        <option value="desc" {{ request('order_by') == 'desc' ? 'selected' : '' }}>Data de Criação: Descendente </option>
                                    </select>
                                </div>
                                                              
                                <div class="form-group mr-2">
                                    <select name="availability" class="form-control">
                                        <option value="">Selecione a Disponibilidade</option>
                                        <option value="aguardando" {{ request('availability') == 'aguardando' ? 'selected' : '' }}>Aguardando </option>
                                        <option value="em progresso" {{ request('availability') == 'em progresso' ? 'selected' : '' }}>Em Progresso </option>
                                        <option value="pausada" {{ request('availability') == 'pausada' ? 'selected' : '' }}>Pausada </option>
                                        <option value="terminada" {{ request('availability') == 'terminada' ? 'selected' : '' }}>Terminada </option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Filtrar</button>
                            </form>
                        </div>                                            
                            <!-- Lista de Tarefas -->
                        <div class="col-md-12  m-5  p-5">
                            <h2 class="mb-4">Minhas Tarefas</h2>
                    
                            <ul class="list-group">
                                
                                @foreach ($tasks as $task)
                                    <div class="border border-dark rounded-3 m-1 p-5 my-5" style="border-radius: 20px; background-color: #f0f8ff;">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Nome da tarefa : {{ $task->title }} </br>
                                            Categoria: {{ $task->category->name }} </br>
                                            Data de criação: {{ $task->created_at->format('d/m/Y H:i') }} </br>
                                            Status: 
                                            @php
                                                switch ($task->status) {
                                                    case 0:
                                                        $status = 'Pendente';
                                                        break;
                                                    case 1:
                                                        $status = 'Em Progresso';
                                                        break;
                                                    case 2:
                                                        $status = 'Concluída';
                                                        break;
                                                    default:
                                                        $status = 'Desconhecido';
                                                        break;
                                                }
                                            @endphp
                                            {{ ucfirst($status) }} </br>

                                            Disponibilidade: 
                                            @php
                                                switch ($task->availability) {
                                                    case 0:
                                                        $availability = 'Aguardando';
                                                        break;
                                                    case 1:
                                                        $availability = 'Em Progresso';
                                                        break;
                                                    case 2:
                                                        $availability = 'Pausada';
                                                        break;
                                                    case 3:
                                                        $availability = 'Terminada';
                                                        break;
                                                    default:
                                                        $availability = 'Desconhecida';
                                                        break;
                                                }
                                            @endphp
                                            {{ ucfirst($availability) }}

                                            <div class="btn-group" role="group">
                                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm mx-4" data-toggle="modal" data-target="#editTaskModal-{{ $task->id }}">Editar</a>
                                                <form method="POST" action="{{ route('tasks.destroy', $task->id) }}" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                                                </form>
                                            </div>
                                        </li>

                                        <!-- Modal de Edição de Tarefa -->
                                        <div id="editTaskModal-{{ $task->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editTaskModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editTaskModalLabel">Editar Tarefa</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" action="{{ route('tasks.update', $task->id) }}">
                                                            @csrf
                                                            @method('PUT')

                                                            <div class="form-group">
                                                                <label for="title">Título</label>
                                                                <input type="text" name="title" value="{{ old('title', $task->title) }}" class="form-control" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="description">Descrição</label>
                                                                <textarea name="description" id="description" class="form-control" required></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="category_id">Categoria</label>
                                                                <select name="category_id" class="form-control" required>
                                                                    @foreach ($categories as $category)
                                                                        <option value="{{ $category->id }}" {{ old('category_id', $task->category_id) == $category->id ? 'selected' : '' }}>
                                                                            {{ $category->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="status">Status</label>
                                                                <select name="status" class="form-control">
                                                                    <option value="0" {{ old('status', $task->status) == 'pendente' ? 'selected' : '' }}>Pendente</option>
                                                                    <option value="1" {{ old('status', $task->status) == 'em andamento' ? 'selected' : '' }}>Em Andamento</option>
                                                                    <option value="2" {{ old('status', $task->status) == 'concluída' ? 'selected' : '' }}>Concluída</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="availability">Disponibilidade</label>
                                                                <select name="availability" class="form-control">
                                                                    <option value="0" {{ old('availability', $task->availability) == 'aguardando' ? 'selected' : '' }}>Aguardando</option>
                                                                    <option value="1" {{ old('availability', $task->availability) == 'em progresso' ? 'selected' : '' }}>Em Progresso</option>
                                                                    <option value="2" {{ old('availability', $task->availability) == 'pausada' ? 'selected' : '' }}>Pausada</option>
                                                                    <option value="3" {{ old('availability', $task->availability) == 'terminada' ? 'selected' : '' }}>Terminada</option>
                                                                </select>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach                           
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    
  

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
      <!-- Importando SweetAlert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        @if(session('message'))
        <script>
            Swal.fire({
                icon: '{{ session('message.type') }}',
                title: 'Resultado',
                text: '{{ session('message.text') }}'
            });
        </script>
        @endif
    

    </div>
</x-app-layout>
