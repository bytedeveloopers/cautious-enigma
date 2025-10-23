<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class CertificateController extends Controller
{
    public function generate($lessonId)
    {
        $lesson = Lesson::findOrFail($lessonId);
        $user = auth()->user();

        // Check if user completed the lesson
        $enrollment = $user->enrolledLessons()
            ->where('lesson_id', $lessonId)
            ->first();

        if (!$enrollment || !$enrollment->pivot->completed) {
            return back()->with('error', 'Debes completar la lección para obtener el certificado');
        }

        // Check if certificate already exists
        $certificate = Certificate::firstOrCreate(
            [
                'user_id' => $user->id,
                'lesson_id' => $lessonId
            ],
            [
                'final_score' => 100,
                'metadata' => [
                    'completion_date' => $enrollment->pivot->completed_at,
                    'time_spent' => $enrollment->pivot->time_spent
                ]
            ]
        );

        return view('certificates.show', compact('certificate', 'lesson'));
    }

    public function download($certificateId)
    {
        $certificate = Certificate::where('user_id', auth()->id())
            ->with(['lesson', 'user'])
            ->findOrFail($certificateId);

        $pdf = Pdf::loadView('certificates.pdf', compact('certificate'));
        
        return $pdf->download('certificado-' . $certificate->certificate_number . '.pdf');
    }

    public function index()
    {
        $certificates = auth()->user()
            ->certificates()
            ->with('lesson')
            ->orderByDesc('issued_at')
            ->get();

        return view('certificates.index', compact('certificates'));
    }
}
