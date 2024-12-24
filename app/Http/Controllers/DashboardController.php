<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function index()
    {
        if (Auth::user()->role === 'MANAGER') {
            return redirect()->route('assetmasuk.index');
        }

        $assets = Asset::all();
        return view('dashboard.index', [
            'assets' => $assets,
        ]);
    }

    public function page_edit($id)
    {
        if (Auth::user()->role === 'MANAGER') {
            return redirect()->route('assetmasuk.index');
        }

        $asset = Asset::find($id);

        if (!$asset) {
            return redirect('/dashboard');
        }

        return view('dashboard.edit', [
            'asset' => $asset,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_asset' => 'required|string|max:255|min:3',
            'tgl_beli' => 'required|date',
            'harga_beli' => 'required|numeric|min:0',
            'aktif' => 'required|in:Y,N',
        ], [
            'nama_asset.required' => 'Nama asset harus diisi.',
            'nama_asset.min' => 'Nama asset minimal 3 karakter.',
            'tgl_beli.required' => 'Tanggal beli harus diisi.',
            'harga_beli.required' => 'Harga beli harus diisi.',
            'aktif.required' => 'Status harus diisi.',
        ]);

        $getLastAsset = Asset::orderBy('kodeasset', 'desc')->first();
        $lastKode = $getLastAsset ? $getLastAsset->kodeasset : 'A0000';

        $lastNumber = (int) substr($lastKode, 1);
        $nextNumber = $lastNumber + 1;

        $kode_asset = 'A' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        Asset::create([
            'kodeasset' => $kode_asset,
            'namaasset' => $validated['nama_asset'],
            'tglbeli' => $validated['tgl_beli'],
            'hrgbeli' => $validated['harga_beli'],
            'aktif' => $validated['aktif'],
        ]);


        return redirect()->route('dashboard_index');
    }

    public function update($id)
    {
        $validated = request()->validate([
            'nama_asset' => 'required|string|max:255|min:3',
            'tgl_beli' => 'required|date',
            'harga_beli' => 'required|numeric|min:0',
            'aktif' => 'required|in:Y,N',
        ], [
            'nama_asset.required' => 'Nama asset harus diisi.',
            'nama_asset.min' => 'Nama asset minimal 3 karakter.',
            'tgl_beli.required' => 'Tanggal beli harus diisi.',
            'harga_beli.required' => 'Harga beli harus diisi.',
            'aktif.required' => 'Status harus diisi.',
        ]);

        $asset = Asset::find($id);

        $asset->update([
            'namaasset' => $validated['nama_asset'],
            'tglbeli' => $validated['tgl_beli'],
            'hrgbeli' => $validated['harga_beli'],
            'aktif' => $validated['aktif'],
        ]);

        return redirect()->route('dashboard_index');
    }

    public function destroy($id)
    {
        $asset = Asset::find($id);

        $asset->delete();


        return redirect()->route('dashboard_index');
    }
}
