<?php

namespace App\Http\Controllers\Admin\Layanan\PusatPengembangan;

use App\Models\ProgramStudi;
use App\Http\Controllers\Controller;
use App\Models\AsesorBKD;
use Illuminate\Http\Request;

class DaftarAsesorBKDAdminController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $programStudi = $request->program_studi;
        $periode = $request->periode;
        $perPage = $request->per_page ?? 10;

        $data = AsesorBKD::with('programStudi')

            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_dosen', 'like', "%{$search}%")
                        ->orWhere('nira', 'like', "%{$search}%")
                        ->orWhere('periode', 'like', "%{$search}%")
                        ->orWhereHas('programStudi', function ($ps) use ($search) {
                            $ps->where('nama', 'like', "%{$search}%");
                        });
                });
            })

            ->when($programStudi, function ($query) use ($programStudi) {
                $query->where('program_studi_id', $programStudi);
            })

            ->when($periode, function ($query) use ($periode) {
                $query->where('periode', $periode);
            })

            ->latest()
            ->paginate($perPage)
            ->withQueryString();

        $listProgramStudi = ProgramStudi::orderBy('nama')->get();
        $listPeriode = AsesorBKD::select('periode')->distinct()->pluck('periode');

        $currentYear = date('Y');

        $totalAsesor = AsesorBKD::count();

        $aktif = AsesorBKD::whereRaw("CAST(SUBSTRING_INDEX(periode, '-', -1) AS UNSIGNED) >= ?", [$currentYear])->count();

        $nonAktif = AsesorBKD::whereRaw("CAST(SUBSTRING_INDEX(periode, '-', -1) AS UNSIGNED) < ?", [$currentYear])->count();

        // ================= AJAX RETURN =================
        if ($request->ajax()) {
            return view('admin.layanan.admin_pusat_pengembangan.daftar_asesor_bkd.partials.table', compact('data'))->render();
        }

        // ================= NORMAL RETURN =================
        return view('admin.layanan.admin_pusat_pengembangan.daftar_asesor_bkd.index', compact('data', 'listProgramStudi', 'listPeriode', 'totalAsesor', 'aktif', 'nonAktif'));
    }
    //Create
    public function create()
    {
        $listProgramStudi = ProgramStudi::orderBy('nama')->get();
        return view('admin.layanan.admin_pusat_pengembangan.daftar_asesor_bkd.create', compact('listProgramStudi'));
    }
    // ================= STORE =================
    public function store(Request $request)
    {
        $request->validate([
            'nama_dosen' => 'required',
            'nira' => 'required',
            'program_studi' => 'required|exists:program_studis,id',
            'periode' => [
                'required',
                'regex:/^\d{4}-\d{4}$/',
                function ($attribute, $value, $fail) {
                    [$start, $end] = explode('-', $value);
                    if ($start >= $end) {
                        $fail('Tahun akhir harus lebih besar dari tahun awal.');
                    }
                },
            ],
        ]);

        AsesorBKD::create([
            'nama_dosen' => $request->nama_dosen,
            'nira' => $request->nira,
            'program_studi_id' => $request->program_studi,
            'periode' => $request->periode,
        ]);

        return redirect()->route('admin.daftar_asesor_bkd.index')->with('success', 'Data berhasil ditambahkan');
    }
    public function edit($id)
    {
        $data = AsesorBKD::findOrFail($id);
        return view('admin.layanan.admin_pusat_pengembangan.daftar_asesor_bkd.edit', compact('data'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_dosen' => 'required',
            'nira' => 'required',
            'program_studi' => 'required|exists:program_studis,id',
            'periode' => [
                'required',
                'regex:/^\d{4}-\d{4}$/',
                function ($attribute, $value, $fail) {
                    [$start, $end] = explode('-', $value);

                    if ($start >= $end) {
                        $fail('Tahun akhir harus lebih besar dari tahun awal.');
                    }
                },
            ],
        ]);

        $data = AsesorBKD::findOrFail($id);

        $data->update([
            'nama_dosen' => $request->nama_dosen,
            'nira' => $request->nira,
            'program_studi_id' => $request->program_studi,
            'periode' => $request->periode,
        ]);

        return redirect()->route('admin.daftar_asesor_bkd.index')->with('success', 'Data berhasil diperbarui');
    }
    public function destroy($id)
    {
        $data = AsesorBKD::findOrFail($id);
        $data->delete();

        return redirect()->route('admin.daftar_asesor_bkd.index')->with('success', 'Data berhasil dihapus');
    }
}
