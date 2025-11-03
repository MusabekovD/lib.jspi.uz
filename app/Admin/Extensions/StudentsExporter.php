<?php

namespace App\Admin\Extensions;

use Encore\Admin\Grid\Exporters\ExcelExporter;

class StudentsExporter extends ExcelExporter
{
    protected $fileName = 'Nazoratchilar.xlsx';

    protected $columns = [
        'id' => 'ID',
        'fio' => 'F.I.O',
        'work' => 'Ish joyi',
        'tell' => 'Telefon',
        'adress' => 'Hudud',
        'created_at' => 'Sana',
    ];
}
