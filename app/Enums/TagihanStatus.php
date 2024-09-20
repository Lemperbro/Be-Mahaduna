<?php
namespace App\Enums;

enum TagihanStatus: string
{
    case BELUM_BAYAR = 'belum dibayar';
    case SUDAH_BAYAR = 'sudah dibayar';
    case MENUNGGU_BAYAR = 'menunggu dibayar';
}