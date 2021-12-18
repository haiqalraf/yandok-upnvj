<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Suket;
use App\Models\BuktiPembayaran;
use Illuminate\Database\Eloquent\Factories\Factory;

class SuketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Suket::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // $arrays = $this->faker->randomElements(["jenis_pengganti", "jenis_perubahan", "jenis_ralat"]);
        // $collection = collect([]);
        // foreach ($arrays as $array) {
        //     if ($array == "jenis_pengganti") {
        //         $collection->push([$array => ]);
        //     }
        //     $collection = collect();
        // }

        return [
            'dokumen_dipesan' => collect([
                "jenis_pengganti" => [
                    "1" => "Surat Keterangan Pengganti Ijazah",
                    "2" => "Surat Keterangan Pengganti Transkrip",
                    "3" => "Surat Keterangan Pengganti SKPI"
                ],
                "jenis_perubahan" => [
                    "1" => "Surat Keterangan Perubahan Ijazah",
                    "2" => "Surat Keterangan Perubahan Transkrip"
                ],
                "jenis_ralat" => [
                    "1" => "Surat Keterangan Ralat Ijazah",
                    "2" => "Surat Keterangan Ralat Transkrip"
                ],
                "jenis_alumni" => ["1" => "Surat Keterangan Alumni"]
            ]),
            'tujuan' => $this->faker->randomElement(['1', '2']),
            'verifikasi' => rand(0,3),
            'completed_at' => $this->faker->dateTimeBetween(now(), now()->addDays(rand(0, 5))),
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function (Suket $suket) {
            if ($suket->raw_tujuan == '2') {
                $suket->alamat = $this->faker->address();
                if ($suket->verifikasi == 3) {
                    $suket->biaya = 10000;
                }
            }
        })->afterCreating(function (Suket $suket) {
            if ($suket->raw_tujuan == '2') {
                if ($suket->verifikasi==3) {
                    $suket->verifikasi_pengiriman = rand(1, 4);
                    if ($suket->verifikasi_pengiriman >= 2) {
                        $buktiBayar = new BuktiPembayaran([
                            "bank" => $this->faker->randomElement(['BNI', 'BCA', 'BRI']),
                            "owner" => User::where('nim', $suket->nim_pemesan)->first()->name,
                            "norek" => $this->faker->iban(),
                            "jml_bayar" => 10000,
                            "tgl_bayar" => $this->faker->dateTimeBetween($suket->completed_at, $suket->completed_at->addDays(rand(0, 1))),
                            "bukti_bayar" => '20211116151558_buktibayar_FSP161121Y187_Mentari.png'
                        ]);
                        if ($suket->verifikasi_pengiriman >= 3) {
                            $buktiBayar->is_confirmed = true;
                            $buktiBayar->confirmed_at = $this->faker->dateTimeBetween($suket->completed_at, $suket->completed_at->addDays(rand(0, 1)));
                            $suket->sent_at = $buktiBayar->confirmed_at;
                        }
                        if ($suket->verifikasi_pengiriman >= 4) {
                            $suket->accepted_at = $this->faker->dateTimeBetween($suket->sent_at, $suket->sent_at->addDays(rand(0, 5)));
                        }
                        $suket->save();
                        $suket->buktiBayar()->save($buktiBayar);
                    }
                }
            }
        });
    }
}
