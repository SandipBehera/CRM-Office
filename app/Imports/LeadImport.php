<?php

namespace App\Imports;

use App\Models\Leads;
use Maatwebsite\Excel\Concerns\ToModel;

class LeadImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Leads([
            'name'=>$row[1],
            'email_id'=>$row[2],
            'phone'=>$row[3],
            'leads_from'=>$row[4],
            'leads_for'=>$row[5],
            'asssigned_to'=>$row[6],
            'assigned_date'=>$row[7],
        ]);
    }
}
