<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserTasksController extends Controller
{
    // Método para listar as tarefas do usuário
    public function index(Request $request)
    {
        $query = Task::where('user_id', Auth::id()); // Filtra tarefas do usuário logado

        // Filtragem por categoria
        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }

        // Ordenação pelas tarefas (por data de criação)
        if ($request->has('order_by')) {
            $query->orderBy('created_at', $request->order_by);
        }

        // Adicionando as categorias aqui para passar para a view
        $tasks = $query->get();
        $categories = Category::all();

        // Mensagem para o SweetAlert no front-end
        $message = session('message', '');

        return view('tasks.index', compact('tasks', 'categories', 'message')); // Passando as variáveis para a view
    }

    // Método para criar nova tarefa
    public function create()
    {
        $categories = Category::all(); // Pegando todas as categorias
        return view('tasks.create', compact('categories')); // Passando para a view
    }

    // Método para armazenar nova tarefa
    public function store(Request $request)
    {
        // Validação dos campos
        $request->validate([
            'title' => 'required|min:5',
            'category_id' => 'required|exists:categories,id', // Verifica se a categoria existe
            'description' => 'nullable|string', // Valida descrição, se fornecida
            'availability' => 'nullable|in:0,1,2,3', // Validação para availability (aguardando, em progresso, terminada, pausada)
            'status' => 'nullable|in:0,1,2', // Validação para status (pendente, em progresso, concluída)
        ]);

        // Garantir que o valor de 'availability' seja válido
        $availability = (int)$request->input('availability', 0); // Define 0 (aguardando) como padrão

        // Garantir que o valor de 'status' seja válido
        $status = $request->input('status', 0); // Define 'pendente' como padrão

        // Criar nova tarefa
        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $status, // Usar o status vindo do formulário
            'availability' => $availability,
            'category_id' => $request->category_id,
            'user_id' => Auth::id(),
        ]);

        // Redireciona para a lista de tarefas com uma mensagem de sucesso
        return redirect()->route('tasks.index')->with('message', [
            'type' => 'success',
            'text' => 'Tarefa criada com sucesso!'
        ]);
    }

    // Método para editar tarefa
    public function edit(Task $task)
    {
        // Verifica se a tarefa pertence ao usuário
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        // Passando a tarefa e as categorias para a view
        $categories = Category::all();
        return view('tasks.edit', compact('task', 'categories'));
    }

    // Método para atualizar tarefa
    public function update(Request $request, Task $task)
    {
        // Verifica se a tarefa pertence ao usuário
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        // Validação dos campos
        $request->validate([
            'title' => 'required|min:5',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string', // Valida descrição, se fornecida
            'availability' => 'nullable|in:0,1,2,3', // Validação para availability (aguardando, em progresso, terminada, pausada)
        ]);

        // Verifica se a descrição foi enviada. Caso não, usa a descrição atual da tarefa.
        $description = $request->description ?: $task->description;

        // Atualiza a tarefa
        $task->update([
            'title' => $request->title,
            'description' => $description,
            'category_id' => $request->category_id,
            'status' => $request->input('status', 'pendente'), // Valor default caso não fornecido
            'availability' => $request->input('availability', 0), // Valor default caso não fornecido
        ]);

        // Redireciona para a lista de tarefas com uma mensagem de sucesso
        return redirect()->route('tasks.index')->with('message', [
            'type' => 'success',
            'text' => 'Tarefa atualizada com sucesso!'
        ]);
    }

    // Método para excluir tarefa
    public function destroy(Task $task)
    {
        // Verifica se a tarefa pertence ao usuário
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        // Deleta a tarefa
        $task->delete();

        // Redireciona para a lista de tarefas com uma mensagem de sucesso
        return redirect()->route('tasks.index')->with('message', [
            'type' => 'success',
            'text' => 'Tarefa excluída com sucesso!'
        ]);
    }

    // Método para criar nova categoria
    public function storeCategory(Request $request)
    {
        // Validação dos campos
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Criar nova categoria
        Category::create([
            'name' => $request->name,
        ]);

        // Redireciona para a lista de categorias com uma mensagem de sucesso
        return redirect()->route('tasks.index')->with('message', [
            'type' => 'success',
            'text' => 'Categoria criada com sucesso!'
        ]);
    }
}
