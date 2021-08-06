<?php

namespace App\Http\Traits;

use App\Models\User;
use Illuminate\Support\Str;

trait UsesUuid
{
    protected static function bootUsesUuid()
    {
        static::creating(function ($model) {
            if (!$model->getKey()) {
                // Use Random Generate
                $date = now("Asia/Jakarta")->format('dmy');
                $nim = '';
                if ($model->nim_pemesan) {
                    $nim = User::where('nim', $model->nim_pemesan)->first()->fakultas;
                }
                do {
                    $random = '';
                    $length = 4;
                    for ($i = 0; $i < $length; $i++) {
                        $random .= (rand(0, 1) ? rand(0, 9) : chr(rand(ord('a'), ord('z'))));
                    }
                    $uid = Str::upper($nim.$date.$random);
                } while ($model->where('id', $uid)->exists());
                $model->{$model->getKeyName()} = (string) $uid;
            }
        });
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }

    protected function generate_random_letters($length) {
        $random = '';
        for ($i = 0; $i < $length; $i++) {
            $random .= chr(rand(ord('a'), ord('z')));
        }
        return $random;
    }
}
