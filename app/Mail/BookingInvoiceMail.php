<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf; // Import PDF Facade

class BookingInvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function build()
    {
        // 1. Load View Invoice dan Masukkan Data
        $pdf = Pdf::loadView('pdf.invoice', ['booking' => $this->booking]);

        // 2. Kirim Email dengan Lampiran PDF
        return $this->subject('Invoice Pembayaran - Sunset Hotel #' . $this->booking->order_id)
                    ->view('email.booking_success') // View body email (pesan singkat)
                    ->attachData($pdf->output(), 'invoice_' . $this->booking->order_id . '.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}