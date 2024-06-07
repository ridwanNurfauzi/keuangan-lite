<?php

namespace App\Http\Controllers;

use App\Models\Cashflow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CashflowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cashflows = Cashflow::all()->reverse();
        return view('cashflows.index', ['cashflows' => $cashflows]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cashflows.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'max:64'],
            'amount' => ['required', 'numeric'],
            'type' => ['required'],
        ], [
            'title.required' => 'Judul tidak dapat dikosongkan.',
            'title.max' => 'Judul tidak dapat lebih dari 64 karakter.',
            'amount.required' => 'Jumlah harus diisi.',
            'amount.numeric' => 'Jumlah harus berupa angka.',
            'type.required' => 'Jenis harus dipilih.'
        ]);

        $cashflow = new Cashflow();
        $cashflow->fill($request->all());
        $cashflow->save();

        Session::flash('session-flash', [
            'msg' => 'Berhasil menambah data.',
            'color' => 'blue'
        ]);

        return redirect()->route('cashflows.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cashflow = Cashflow::find($id);
        return view('cashflows.show', ['cashflow' => $cashflow]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cashflow = Cashflow::find($id);
        return view('cashflows.edit', ['cashflow' => $cashflow]);
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => ['required', 'max:64'],
            'amount' => ['required', 'numeric'],
            'type' => ['required'],
        ], [
            'title.required' => 'Judul tidak dapat dikosongkan.',
            'title.max' => 'Judul tidak dapat lebih dari 64 karakter.',
            'amount.required' => 'Jumlah harus diisi.',
            'amount.numeric' => 'Jumlah harus berupa angka.',
            'type.required' => 'Jenis harus dipilih.'
        ]);


        $cashflow = Cashflow::find($id);
        $cashflow->fill($request->all());
        $cashflow->save();
        
        Session::flash('session-flash', [
            'msg' => 'Berhasil mengubah data.',
            'color' => 'blue'
        ]);
        
        return redirect()->route('cashflows.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cashflow = Cashflow::find($id);

        $cashflow->delete();

        Session::flash('session-flash', [
            'msg' => 'Berhasil menghapus data.',
            'color' => 'blue'
        ]);

        return redirect()->route('cashflows.index');
    }
}
