<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
        'user_id',
        'lesson_id',
        'certificate_number',
        'issued_at',
        'pdf_path',
        'final_score',
        'metadata'
    ];

    protected $casts = [
        'issued_at' => 'datetime',
        'final_score' => 'integer',
        'metadata' => 'array'
    ];

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($certificate) {
            if (empty($certificate->certificate_number)) {
                $certificate->certificate_number = self::generateCertificateNumber();
            }
            
            if (empty($certificate->issued_at)) {
                $certificate->issued_at = now();
            }
        });
    }

    /**
     * Generate unique certificate number
     */
    private static function generateCertificateNumber()
    {
        do {
            $number = 'CERT-' . strtoupper(uniqid()) . '-' . date('Y');
        } while (self::where('certificate_number', $number)->exists());
        
        return $number;
    }

    /**
     * Get the user who earned this certificate
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the lesson for this certificate
     */
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    /**
     * Get formatted issue date
     */
    public function getFormattedIssuedAtAttribute()
    {
        return $this->issued_at->format('d/m/Y');
    }

    /**
     * Check if certificate PDF exists
     */
    public function hasPdf()
    {
        return !empty($this->pdf_path) && file_exists(storage_path('app/' . $this->pdf_path));
    }
}
