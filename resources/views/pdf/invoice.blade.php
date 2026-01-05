<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $booking->order_id }}</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; color: #333; line-height: 1.6; }
        .container { width: 100%; margin: 0 auto; }
        
        /* Header Sunset Theme */
        .header { background-color: #fff7ed; padding: 20px; border-bottom: 3px solid #f97316; margin-bottom: 30px; }
        .logo { font-size: 24px; font-weight: bold; color: #1f2937; }
        .logo span { color: #f97316; } /* Orange Sunset */
        
        .invoice-info { margin-bottom: 30px; width: 100%; }
        .invoice-info td { vertical-align: top; }
        .text-right { text-align: right; }
        .text-orange { color: #f97316; }
        .font-bold { font-weight: bold; }

        /* Table Design */
        .table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .table th { background-color: #f97316; color: white; padding: 10px; text-align: left; }
        .table td { border-bottom: 1px solid #ddd; padding: 10px; }
        
        .total-section { width: 100%; margin-top: 20px; }
        .total-row td { padding: 5px 10px; font-size: 16px; }
        .grand-total { font-size: 20px; font-weight: bold; color: #f97316; }

        .footer { margin-top: 50px; text-align: center; font-size: 12px; color: #777; border-top: 1px solid #eee; padding-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        
        <div class="header">
            <table width="100%">
                <tr>
                    <td class="logo"><span>Sunset</span> Hotel</td>
                    <td class="text-right">
                        <strong>INVOICE</strong><br>
                        <span style="color: #666; font-size: 14px;">#{{ $booking->order_id }}</span>
                    </td>
                </tr>
            </table>
        </div>

        <table class="invoice-info">
            <tr>
                <td width="50%">
                    <strong>Diterbitkan Untuk:</strong><br>
                    {{ $booking->user->name ?? 'Guest' }}<br>
                    {{ $booking->user->email ?? '-' }}<br>
                    {{ $booking->user->phone ?? '-' }}
                </td>
                <td width="50%" class="text-right">
                    <strong>Dari:</strong><br>
                    Sunset Hotel Management<br>
                    Jl. Pantai Kuta No. 88, Bali<br>
                    support@sunsethotel.com
                </td>
            </tr>
            <tr>
                <td colspan="2" style="padding-top: 20px;">
                    <strong>Tanggal Booking:</strong> {{ $booking->created_at->format('d M Y') }}<br>
                    <strong>Status:</strong> <span style="color: green; font-weight:bold;">LUNAS (PAID)</span>
                </td>
            </tr>
        </table>

        <table class="table">
            <thead>
                <tr>
                    <th>Deskripsi</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th class="text-right">Harga</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <strong>{{ $booking->room->name ?? 'Kamar' }}</strong><br>
                        <small>Tipe Kamar: {{ $booking->room->type ?? 'Standard' }}</small>
                    </td>
                    <td>{{ $booking->check_in }}</td>
                    <td>{{ $booking->check_out }}</td>
                    <td class="text-right">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <table class="total-section">
            <tr class="total-row">
                <td class="text-right" width="80%">Subtotal:</td>
                <td class="text-right">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
            </tr>
            <tr class="total-row">
                <td class="text-right">Pajak (0%):</td>
                <td class="text-right">Rp 0</td>
            </tr>
            <tr class="total-row">
                <td class="text-right grand-total">TOTAL DIBAYAR:</td>
                <td class="text-right grand-total">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
            </tr>
        </table>

        <div class="footer">
            <p>Terima kasih telah memilih Sunset Hotel untuk liburan Anda.</p>
            <p>Bukti pembayaran ini sah dan diterbitkan secara otomatis oleh komputer.</p>
        </div>
    </div>
</body>
</html>