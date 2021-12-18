<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Lainya;
use App\Models\BuktiPembayaran;
use Illuminate\Database\Eloquent\Factories\Factory;

class LainyaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Lainya::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'dokumen_dipesan' => $this->faker->sentence(5),
            'jumlah_dokumen' => rand(1,100),
            'tujuan' => $this->faker->randomElement(['1', '2']),
            'verifikasi' => rand(1, 3),
            'completed_at' => $this->faker->dateTimeBetween(now(), now()->addDays(rand(0,5))),
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function (Lainya $lainya) {
            if ($lainya->raw_tujuan == '2') {
                $lainya->alamat = $this->faker->address();
                if ($lainya->verifikasi == 3) {
                    $lainya->biaya = 10000;
                }
            }
        })->afterCreating(function (Lainya $lainya) {
            if ($lainya->raw_tujuan == '2') {
                if ($lainya->verifikasi==3) {
                    $lainya->verifikasi_pengiriman = rand(1, 4);
                    if ($lainya->verifikasi_pengiriman >= 2) {
                        $buktiBayar = new BuktiPembayaran([
                            "bank" => $this->faker->randomElement(['BNI', 'BCA', 'BRI']),
                            "owner" => User::where('nim', $lainya->nim_pemesan)->first()->name,
                            "norek" => $this->faker->iban(),
                            "jml_bayar" => 10000,
                            "tgl_bayar" => $this->faker->dateTimeBetween($lainya->completed_at, $lainya->completed_at->addDays(rand(0, 1))),
                            "bukti_bayar" => '20211116151558_buktibayar_FSP161121Y187_Mentari.png'
                        ]);
                        if ($lainya->verifikasi_pengiriman >= 3) {
                            $buktiBayar->is_confirmed = true;
                            $buktiBayar->confirmed_at = $this->faker->dateTimeBetween($lainya->completed_at, $lainya->completed_at->addDays(rand(0, 1)));
                            $lainya->sent_at = $buktiBayar->confirmed_at;
                        }
                        if ($lainya->verifikasi_pengiriman >= 4) {
                            $lainya->accepted_at = $this->faker->dateTimeBetween($lainya->sent_at, $lainya->sent_at->addDays(rand(0, 5)));
                        }
                        $lainya->save();
                        $lainya->buktiBayar()->save($buktiBayar);
                    }
                }
            }
        });
    }
}
