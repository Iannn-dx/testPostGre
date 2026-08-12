<?php

namespace App\Http\Controllers;

use App\Support\ReportData;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ReportController extends Controller
{
    /**
     * Display the report filter and optional generated preview.
     */
    public function index(Request $request): View
    {
        $generated = $request->boolean('generated');
        $startDate = $request->query('start_date', now()->startOfMonth()->toDateString());
        $endDate = $request->query('end_date', now()->toDateString());

        $report = null;

        if ($generated) {
            $request->validate([
                'start_date' => ['required', 'date'],
                'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            ]);

            $start = Carbon::parse($request->query('start_date'))->startOfDay();
            $end = Carbon::parse($request->query('end_date'))->endOfDay();

            $report = ReportData::build(
                $start,
                $end,
                auth()->user()->fullName(),
            );

            $startDate = $start->toDateString();
            $endDate = $end->toDateString();
        }

        return view('reports.index', [
            'report' => $report,
            'generated' => $generated && $report !== null,
            'filters' => [
                'start_date' => $startDate,
                'end_date' => $endDate,
            ],
            'profile' => auth()->user()->toProfileArray(),
        ]);
    }

    /**
     * Download the report as a PDF document.
     */
    public function pdf(Request $request): Response
    {
        $request->validate([
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
        ]);

        $start = Carbon::parse($request->query('start_date'))->startOfDay();
        $end = Carbon::parse($request->query('end_date'))->endOfDay();

        $report = ReportData::build(
            $start,
            $end,
            auth()->user()->fullName(),
        );

        $logoBase64 = is_file($report['logoPath'])
            ? base64_encode((string) file_get_contents($report['logoPath']))
            : null;

        $filename = sprintf(
            'cagayan-museum-report-%s-to-%s.pdf',
            $start->format('Y-m-d'),
            $end->format('Y-m-d'),
        );

        $pdf = Pdf::loadView('reports.pdf', [
            'report' => $report,
            'logoBase64' => $logoBase64,
        ])
            ->setPaper('a4', 'portrait')
            ->setOption('isPhpEnabled', true);

        return $pdf->download($filename);
    }
}
