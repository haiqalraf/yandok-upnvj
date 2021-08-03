<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Suket;
use App\Notifications\Pesanan;
use Illuminate\Support\Facades\Notification;

class SuratObserver
{
    /**
     * Handle the Suket "created" event.
     *
     * @param  \App\Models\Suket  $suket
     * @return void
     */
    public function created(Suket $suket)
    {
        $user = User::where('nim', $suket->nim_pemesan)->first();
        $user->notify(new Pesanan(['message'=>'Pesanan '.$suket->id.' telah dibuat']));
        $akpk = User::where('is_admin', 2)->get();
        Notification::send($akpk, new Pesanan([
            'message'=>'Pesanan '.$suket->id.' telah dibuat',
        ]));
    }

    /**
     * Handle the Suket "updated" event.
     *
     * @param  \App\Models\Suket  $suket
     * @return void
     */
    public function updated(Suket $suket)
    {
        $user = User::where('nim', $suket->nim_pemesan)->first();
        if ($suket->verifikasi==2) {
            $user->notify(new Pesanan(['message'=>'Pesanan '.$suket->id.' sedang diverifikasi/dibuat']));
            $dekan = User::where('is_admin', 3)->get();
            Notification::send($dekan, new Pesanan([
                'message'=>'Pesanan '.$suket->id.' telah diverifikasi',
            ]));
        } elseif ($suket->verifikasi==3) {
            $user->notify(new Pesanan(['message'=>'Pesanan '.$suket->id.' telah diverifikasi/selesai']));
        }
    }

    /**
     * Handle the Suket "deleted" event.
     *
     * @param  \App\Models\Suket  $suket
     * @return void
     */
    public function deleted(Suket $suket)
    {
        //
    }

    /**
     * Handle the Suket "restored" event.
     *
     * @param  \App\Models\Suket  $suket
     * @return void
     */
    public function restored(Suket $suket)
    {
        //
    }

    /**
     * Handle the Suket "force deleted" event.
     *
     * @param  \App\Models\Suket  $suket
     * @return void
     */
    public function forceDeleted(Suket $suket)
    {
        //
    }
}
