<?php

namespace App\Imports;

use App\Models\Team;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TeamImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $name = $row['egyesulet_neve'];
        $sa = trim($row['mszuosz_kod']);

        $team = Team::firstOrNew(['SA' => $sa]);

        if(! $team->exists) {
            $team->name = $name;
        }

        $team->original_name = $name;
        $team->address = $row['szekhely'];

        $arr = explode('/', $row['elnokkapcsolattarto']);
        if(array_key_exists(0, $arr)) {
            $team->president = $arr[0];
            if(array_key_exists(1, $arr)) {
                $team->contact_name = $arr[1];
            }
        }
        $team->email = $row['e_mail_cim'];
        $team->phone = $row['mobil_telefon'];

        $team->save();

        return $team;
    }
}
