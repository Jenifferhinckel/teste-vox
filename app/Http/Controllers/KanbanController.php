<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;
use App\Http\Requests\KanbanRequest;
use App\Models\Category;

class KanbanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all()->sortBy('name');
        $board = Board::all();
        return view('kanban/kanban', compact('categories', 'board'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('kanban/create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(KanbanRequest $request)
    {
        Board::create($request->validated());

        return redirect()->route('kanban.index')->with('success', 'Kanban criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $board = Board::find($id);
        $categories = Category::all();

        if (!$board) {
            return redirect()->route('kanban.index')->with('error', 'Kanban não encontrado.');
        }

        return view('kanban/edit', compact('board', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(KanbanRequest $request, string $id)
    {
        $board = Board::find($id);

        if (!$board) {
            return redirect()->route('kanban.index')->with('error', 'Kanban não encontrado.');
        }

        $board->update($request->validated());

        return redirect()->route('kanban.index')->with('success', 'Kanban atualizado com sucesso!');
    }

    /**
     * Update the position and category_id.
     */
    public function updatePosition(Request $request)
    {
        $validatedData = $request->validate([
            'category_id' => 'required|integer|exists:categories,id',
            'positions' => 'required',
        ]);

        $board = Board::find($request->id);

        if (!$board) {
            return response()->json([
                'error' => true,
                'message' => 'Kanban não encontrado.'
            ]);
        }

        $board->category_id = $validatedData['category_id'];
        $board->save();

        foreach ($request->positions as $index => $itemId) {
            $item = Board::find($itemId);
            $item->category_id = $request->category_id;
            $item->position = $index;
            $item->save();
        }


        return response()->json([
            'success' => true,
            'message' => 'Kanban atualizado com sucesso!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $board = Board::find($id);

        if (!$board) {
            return redirect()->route('kanban.index')->with('error', 'Kanban não encontrado.');
        }

        $board->delete();

        return redirect()->route('kanban.index')->with('success', 'Kanban excluído com sucesso!');
    }
}
