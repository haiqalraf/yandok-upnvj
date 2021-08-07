<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Lainya;
use App\Notifications\Pesanan;
use Illuminate\Support\Facades\Notification;

class LainnyaObserver
{
    /**
     * Handle the Lainya "created" event.
     *
     * @param  \App\Models\Lainya  $lainya
     * @return void
     */
    public function created(Lainya $lainya)
    {
        $user = User::where('nim', $lainya->nim_pemesan)->first();
        $user->notify(new Pesanan(['model_pesanan' => 'lainnya', 'id_pesanan'  => $lainya->id, 'message'=>'Pesanan '.$lainya->id.' telah dibuat']));
        $akpk = User::where('is_admin', 2)->get();
        Notification::send($akpk, new Pesanan([
            'model_pesanan' => 'lainnya', 'id_pesanan'  => $lainya->id, 'message'=>'Pesanan '.$lainya->id.' telah dibuat',
        ]));
    }

    /**
     * Handle the Lainya "updated" event.
     *
     * @param  \App\Models\Lainya  $lainya
     * @return void
     */
    public function updated(Lainya $lainya)
    {
        $user = User::where('nim', $lainya->nim_pemesan)->first();
        if ($lainya->verifikasi==2) {
            $user->notify(new Pesanan(['model_pesanan' => 'lainnya', 'id_pesanan'  => $lainya->id, 'message'=>'Pesanan '.$lainya->id.' sedang diverifikasi/dibuat']));
            $dekan = User::where('is_admin', 3)->get();
            Notification::send($dekan, new Pesanan([
                'model_pesanan' => 'lainnya', 'id_pesanan'  => $lainya->id, 'message'=>'Pesanan '.$lainya->id.' telah diverifikasi',
            ]));
        } elseif ($lainya->verifikasi==3) {
            $user->notify(new Pesanan(['model_pesanan' => 'lainnya', 'id_pesanan'  => $lainya->id, 'message'=>'Pesanan '.$lainya->id.' telah diverifikasi/selesai']));
        } elseif ($lainya->verifikasi==0) {
            $user->notify(new Pesanan(['model_pesanan' => 'lainnya', 'id_pesanan'  => $lainya->id, 'message'=>'Pesanan '.$lainya->id.' ditolak']));
        }
    }

    /**
     * Handle the Lainya "deleted" event.
     *
     * @param  \App\Models\Lainya  $lainya
     * @return void
     */
    public function deleted(Lainya $lainya)
    {
        //
    }

    /**
     * Handle the Lainya "restored" event.
     *
     * @param  \App\Models\Lainya  $lainya
     * @return void
     */
    public function restored(Lainya $lainya)
    {
        //
    }

    /**
     * Handle the Lainya "force deleted" event.
     *
     * @param  \App\Models\Lainya  $lainya
     * @return void
     */
    public function forceDeleted(Lainya $lainya)
    {
        //
    }
}
