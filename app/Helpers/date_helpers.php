<?php

if (! function_exists('indo_date')) {
    /**
     * Format tanggal Indonesia (default WIB).
     * Contoh: indo_date('2025-09-10 09:30') -> "Rabu, 10 September 2025 09.30"
     */
    function indo_date($time = 'now', string $pattern = 'EEEE, d MMMM y HH.mm', string $tz = 'Asia/Jakarta'): string
    {
        // Normalisasi ke DateTimeImmutable
        $zone = new DateTimeZone($tz);
        if ($time instanceof DateTimeInterface) {
            $dt = (new DateTimeImmutable($time->format('c')))->setTimezone($zone);
        } elseif (is_int($time)) {
            $dt = (new DateTimeImmutable('@' . $time))->setTimezone($zone);
        } else {
            $ts = strtotime((string) $time);
            if ($ts === false) $ts = time();
            $dt = (new DateTimeImmutable('@' . $ts))->setTimezone($zone);
        }

        // Pakai Intl kalau tersedia
        if (class_exists(IntlDateFormatter::class)) {
            $fmt = new IntlDateFormatter('id_ID', IntlDateFormatter::FULL, IntlDateFormatter::MEDIUM, $tz, null, $pattern);
            return $fmt->format($dt) ?: $dt->format('d/m/Y H:i');
        }

        // Fallback manual (tanpa ekstensi intl)
        $hari  = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        return $hari[(int)$dt->format('w')]
            . ', ' . (int)$dt->format('j')
            . ' ' . $bulan[(int)$dt->format('n')]
            . ' ' . $dt->format('Y')
            . ' ' . $dt->format('H.i');
    }
}
