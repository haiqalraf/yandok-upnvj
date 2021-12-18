<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Legalisir;
use App\Models\BuktiPembayaran;
use Illuminate\Database\Eloquent\Factories\Factory;

class LegalisirFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Legalisir::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'dok_01' => rand(0,20),
            'dok_02' => rand(0,20),
            'dok_03' => rand(0,20),
            'dok_04' => rand(0,20),
            'dok_05' => rand(0,20),
            'dok_06' => rand(0,20),
            'dok_07' => rand(0,20),
            'dok_08' => rand(0,20),
            'dok_09' => rand(0,20),
            'dok_10' => rand(0,20),
            'dok_11' => rand(0,20),
            'dok_12' => rand(0,20),
            'kebutuhan' => $this->faker->randomElement(['ASN', 'TNI atau Polri', 'Swasta', 'Lainnya']),
            'keterangan' => 'tidak ada keterangan',
            'tujuan' => $this->faker->randomElement(['1', '2']),
            'verifikasi' => 3,
            'completed_at' => $this->faker->dateTimeBetween(now(), now()->addDays(rand(0, 5))),
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function (Legalisir $legalisir) {
            if ($legalisir->raw_tujuan == '2') {
                $legalisir->alamat = $this->faker->address();
                if ($legalisir->verifikasi == 3) {
                    $legalisir->biaya = 10000;
                }
            }
        })->afterCreating(function (Legalisir $legalisir) {
            if ($legalisir->raw_tujuan == '2') {
                $legalisir->verifikasi_pengiriman = rand(1, 4);
                if ($legalisir->verifikasi_pengiriman >= 2) {
                    $buktiBayar = new BuktiPembayaran([
                        "bank" => $this->faker->randomElement(['BNI', 'BCA', 'BRI']),
                        "owner" => User::where('nim', $legalisir->nim_pemesan)->first()->name,
                        "norek" => $this->faker->iban(),
                        "jml_bayar" => 10000,
                        "tgl_bayar" => $this->faker->dateTimeBetween($legalisir->completed_at, $legalisir->completed_at->addDays(rand(0, 1))),
                        "bukti_bayar" => '20211116151558_buktibayar_FSP161121Y187_Mentari.png'
                    ]);
                    if ($legalisir->verifikasi_pengiriman >= 3) {
                        $buktiBayar->is_confirmed = true;
                        $buktiBayar->confirmed_at = $this->faker->dateTimeBetween($legalisir->completed_at, $legalisir->completed_at->addDays(rand(0, 1)));
                        $legalisir->sent_at = $buktiBayar->confirmed_at;
                    }
                    if ($legalisir->verifikasi_pengiriman >= 4) {
                        $legalisir->accepted_at = $this->faker->dateTimeBetween($legalisir->sent_at, $legalisir->sent_at->addDays(rand(0, 5)));
                    }
                    $legalisir->save();
                    $legalisir->buktiBayar()->save($buktiBayar);
                }
            }
        });
    }
}
