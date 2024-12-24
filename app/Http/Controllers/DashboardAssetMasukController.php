<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardAssetMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asset_masuk = AssetMasuk::with('asset')->get();
        return view('dashboard.asset_masuk.index', compact('asset_masuk'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $assetsAktif = Asset::where('aktif', 'Y')->get();
        return view('dashboard.asset_masuk.create', compact('assetsAktif'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kodeasset' => 'required|exists:assets,kodeasset',
            'tanggal' => 'required|date',
            'qty' => 'required|integer|min:1',
        ], [
            'kodeasset.required' => 'Harap pilih asset terlebih dahulu.',
            'tanggal.required' => 'Tanggal harus diisi.',
            'qty.required' => 'Quantity harus diisi.',
        ]);

        $asset = Asset::where('kodeasset', $request->kodeasset)->first();

        AssetMasuk::create([
            'kodemasuk' => 'IN' . date('ym') . str_pad(AssetMasuk::count() + 1, 3, '0', STR_PAD_LEFT),
            'kodeasset' => $request->kodeasset,
            'tanggal' => $request->tanggal,
            'qty' => $request->qty,
            'hrgtotal' => $asset->hrgbeli * $request->qty,
            'statusmasuk' => 'PROCESS',
        ]);

        return redirect()->route('assetmasuk.index')->with('success_added_asset_masuk', 'Asset masuk berhasil ditambahkan.');
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
        $assetMasuk = AssetMasuk::find($id);

        if (!$assetMasuk) {
            return redirect()->route('assetmasuk.index');
        }

        $assets = Asset::where('aktif', 'Y')->get();

        return view('dashboard.asset_masuk.edit', compact('assetMasuk', 'assets'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kodeasset' => 'required|exists:assets,kodeasset',
            'tanggal' => 'required|date',
            'qty' => 'required|integer|min:1',
        ], [
            'kodeasset.required' => 'Harap pilih asset terlebih dahulu.',
            'tanggal.required' => 'Tanggal harus diisi.',
            'qty.required' => 'Quantity harus diisi.',
        ]);

        $asset = Asset::where('kodeasset', $request->kodeasset)->first();

        $assetMasuk = AssetMasuk::find($id);

        $assetMasuk->update([
            'kodeasset' => $request->kodeasset,
            'tanggal' => $request->tanggal,
            'qty' => $request->qty,
            'hrgtotal' => $asset->hrgbeli * $request->qty
        ]);

        return redirect()->route('assetmasuk.index')->with('success_updated_asset_masuk', 'Asset masuk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $assetMasuk = AssetMasuk::find($id);

        $assetMasuk->delete();

        return redirect()->route('assetmasuk.index');
    }


    public function approve($id)
    {
        if (Auth::user()->role !== 'MANAGER' && Auth::user()->role !== 'ADMIN') {
            return redirect()->route('assetmasuk.index');
        }

        $assetMasuk = AssetMasuk::find($id);

        $assetMasuk->update([
            'statusmasuk' => 'APPROVED',
        ]);
        return redirect()->route('assetmasuk.index');
    }
}
