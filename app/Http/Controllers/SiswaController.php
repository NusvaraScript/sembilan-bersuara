<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SiswaController extends Controller
{
    private const CSV_HEADERS = ['nis', 'nama_siswa', 'username', 'kelas', 'no_hp', 'password'];

    public function index(): View
    {
        $siswas = Siswa::withCount('pengaduan')
            ->orderBy('nama_siswa')
            ->paginate(10);

        return view('admin.siswa.index', compact('siswas'));
    }

    public function export(): StreamedResponse
    {
        $filename = 'data-siswa-' . now()->format('Ymd-His') . '.csv';

        return response()->streamDownload(function (): void {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, self::CSV_HEADERS);

            Siswa::orderBy('nama_siswa')
                ->chunk(200, function ($siswas) use ($handle): void {
                    foreach ($siswas as $siswa) {
                        fputcsv($handle, [
                            $siswa->nis,
                            $siswa->nama_siswa,
                            $siswa->username,
                            $siswa->kelas,
                            $siswa->no_hp,
                            '',
                        ]);
                    }
                });

            fclose($handle);
        }, $filename, ['Content-Type' => 'text/csv']);
    }

    public function template(): StreamedResponse
    {
        return response()->streamDownload(function (): void {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, self::CSV_HEADERS);
            fputcsv($handle, ['12345', 'Budi Santoso', 'budi.santoso', 'XI RPL 1', '81234567890', 'password123']);
            fclose($handle);
        }, 'template-import-siswa.csv', ['Content-Type' => 'text/csv']);
    }

    public function import(Request $request): RedirectResponse
    {
        $request->validate([
            'csv_file' => ['required', 'file', 'mimes:csv,txt', 'max:2048'],
        ]);

        [$rows, $headerErrors] = $this->readCsvRows($request->file('csv_file')->getRealPath());

        if ($headerErrors !== []) {
            return back()->withErrors(['csv_file' => implode(' ', $headerErrors)]);
        }

        if ($rows === []) {
            return back()->withErrors(['csv_file' => 'File CSV tidak memiliki data siswa.']);
        }

        $errors = $this->validateCsvRows($rows);

        if ($errors !== []) {
            return back()->withErrors(['csv_file' => implode(' ', $errors)]);
        }

        foreach ($rows as $row) {
            Siswa::create([
                'nis' => $row['nis'],
                'nama_siswa' => $row['nama_siswa'],
                'username' => $row['username'],
                'kelas' => $row['kelas'],
                'no_hp' => $row['no_hp'],
                'password' => Hash::make($row['password']),
            ]);
        }

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', count($rows) . ' siswa berhasil diimport dari CSV.');
    }

    private function readCsvRows(string $path): array
    {
        $handle = fopen($path, 'r');
        $header = fgetcsv($handle);

        if ($header === false) {
            fclose($handle);
            return [[], []];
        }

        $header = array_map(fn ($value) => strtolower(trim((string) $value, "\xEF\xBB\xBF \t\n\r\0\x0B")), $header);
        $missingHeaders = array_diff(self::CSV_HEADERS, $header);

        if ($missingHeaders !== []) {
            fclose($handle);

            return [[], ['Header CSV wajib memuat kolom: ' . implode(', ', self::CSV_HEADERS) . '.']];
        }

        $rows = [];
        $line = 1;

        while (($data = fgetcsv($handle)) !== false) {
            $line++;

            if (count(array_filter($data, fn ($value) => trim((string) $value) !== '')) === 0) {
                continue;
            }

            $rows[] = [
                'line' => $line,
                'data' => array_combine($header, array_slice(array_pad($data, count($header), ''), 0, count($header))),
            ];
        }

        fclose($handle);

        return [array_map(function (array $row): array {
            $data = $row['data'];

            return [
                'line' => $row['line'],
                'nis' => trim((string) ($data['nis'] ?? '')),
                'nama_siswa' => trim((string) ($data['nama_siswa'] ?? '')),
                'username' => trim((string) ($data['username'] ?? '')),
                'kelas' => trim((string) ($data['kelas'] ?? '')),
                'no_hp' => trim((string) ($data['no_hp'] ?? '')),
                'password' => trim((string) ($data['password'] ?? '')),
            ];
        }, $rows), []];
    }

    private function validateCsvRows(array $rows): array
    {
        $errors = [];
        $nisInCsv = [];
        $usernameInCsv = [];

        foreach ($rows as $row) {
            $validator = Validator::make($row, [
                'nis' => ['required', 'integer', Rule::unique('siswa', 'nis')],
                'nama_siswa' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'max:255', Rule::unique('siswa', 'username')],
                'kelas' => ['required', 'string', 'max:255'],
                'no_hp' => ['required', 'integer'],
                'password' => ['required', 'string', 'min:6'],
            ]);

            if ($validator->fails()) {
                $errors[] = 'Baris ' . $row['line'] . ': ' . implode(', ', $validator->errors()->all()) . '.';
            }

            if (in_array($row['nis'], $nisInCsv, true)) {
                $errors[] = 'Baris ' . $row['line'] . ': NIS duplikat di file CSV.';
            }

            if (in_array($row['username'], $usernameInCsv, true)) {
                $errors[] = 'Baris ' . $row['line'] . ': Username duplikat di file CSV.';
            }

            $nisInCsv[] = $row['nis'];
            $usernameInCsv[] = $row['username'];
        }

        return $errors;
    }
}