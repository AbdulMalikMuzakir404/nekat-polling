<?php

namespace App\Imports;

use App\Models\ParentUser;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportDataSiswa implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            $user = user::create([
                'name' => $row[0],
                'nis' => $row[1],
                'email' => $row[2],
                'password' => Hash::make($row[3]),
                'password_show' => $row[3]
            ]);

            ParentUser::create([
                'user_id' => $user->id,
                'kelas' => $row[4],
                'jurusan' => $row[5],
                'jenis_kelamin' => $row[6]
            ]);
        }
    }
}
