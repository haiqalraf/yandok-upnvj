<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Legalisir;
use App\Notifications\Pesanan;
use Illuminate\Support\Facades\Notification;

class LegalisirObserver
{
    /**
     * Handle the Legalisir "created" event.
     *
     * @param  \App\Models\Legalisir  $legalisir
     * @return void
     */
    public function created(Legalisir $legalisir)
    {
        $user = User::where('nim', $legalisir->nim_pemesan)->first();
        $user->notify(new Pesanan(['model_pesanan' => 'legalisir', 'id_pesanan'  => $legalisir->id, 'message'=>'Pesanan '.$legalisir->id.' telah dibuat']));
        if ($legalisir->isKebutuhanForAkpk()) {
            $akpk = User::where('is_admin', 2)->get();
            Notification::send($akpk, new Pesanan([
                'model_pesanan' => 'legalisir', 'id_pesanan'  => $legalisir->id, 'message'=>'Pesanan '.$legalisir->id.' telah dibuat',
            ]));
        } else {
            $dekan = User::where('is_admin', 3)->where('fakultas', $user->fakultas)->get();
            Notification::send($dekan, new Pesanan([
                'model_pesanan' => 'legalisir', 'id_pesanan'  => $legalisir->id, 'message' => 'Pesanan ' . $legalisir->id . ' telah dibuat',
            ]));
        }
    }

    /**
     * Handle the Legalisir "updated" event.
     *
     * @param  \App\Models\Legalisir  $legalisir
     * @return void
     */
    public function updated(Legalisir $legalisir)
    {
        $user = User::where('nim', $legalisir->nim_pemesan)->first();
        if ($legalisir->verifikasi==2) {
            $user->notify(new Pesanan(['model_pesanan' => 'legalisir', 'id_pesanan'  => $legalisir->id, 'message'=>'Pesanan '.$legalisir->id.' sedang diverifikasi/dibuat']));
        } elseif ($legalisir->verifikasi==3) {
            $user->notify(new Pesanan(['model_pesanan' => 'legalisir', 'id_pesanan'  => $legalisir->id, 'message'=>'Pesanan '.$legalisir->id.' telah diverifikasi/selesai']));
        } elseif ($legalisir->verifikasi==0) {
            $user->notify(new Pesanan(['model_pesanan' => 'legalisir', 'id_pesanan'  => $legalisir->id, 'message'=>'Pesanan '.$legalisir->id.' ditolak']));
        }
    }

    /**
     * Handle the Legalisir "deleted" event.
     *
     * @param  \App\Models\Legalisir  $legalisir
     * @return void
     */
    public function deleted(Legalisir $legalisir)
    {
        //
    }

    /**
     * Handle the Legalisir "restored" event.
     *
     * @param  \App\Models\Legalisir  $legalisir
     * @return void
     */
    public function restored(Legalisir $legalisir)
    {
        //
    }

    /**
     * Handle the Legalisir "force deleted" event.
     *
     * @param  \App\Models\Legalisir  $legalisir
     * @return void
     */
    public function forceDeleted(Legalisir $legalisir)
    {
        //
    }
}
