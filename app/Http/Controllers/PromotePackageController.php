<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PromotePackageController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin-area');
    }

    public function index()
    {
        $packages = Package::paginate(10);
        return view('packages.index', compact('packages'));
    }

    public function create()
    {
        return view('packages.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'detail' => ['required', 'string', 'max:1000'],
            'price' => ['required', 'numeric'],
            'audience' => ['required', 'string', 'max:255'],
            'duration' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:0,1']
        ]);

        Package::create($data);
        return redirect()->route('packages.index')->with('message', 'Package added successcully !!');
    }

    public function show(Package $package)
    {
        return view('packages.show', compact('package'));
    }

    public function edit(Package $package)
    {
        return view('packages.edit', compact('package'));
    }

    public function update(Request $request, Package $package)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'detail' => ['required', 'string', 'max:1000'],
            'price' => ['required', 'numeric'],
            'audience' => ['required', 'string', 'max:255'],
            'duration' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:0,1']
        ]);

        $package->update($data);
        return redirect()->route('packages.index')->with('message', 'Package updated successcully !!');
    }
}
