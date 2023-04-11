<?php

namespace App\Http\Controllers;

use App\Models\Promote;
use Illuminate\Http\Request;

class PromoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin-area');
    }

    public function index()
    {
        $status = request('status') ?? 1;
        $promotes = Promote::with(['post', 'package'])->where('status', $status)->latest()->paginate(10);
        return view('promotes.index', compact('promotes'));
    }

    public function update(Promote $promote)
    {
        $promote->update(['status' => 0]);
        return redirect()->route('promotes.index')->with('message', 'Promote has been completed!');
    }
}
