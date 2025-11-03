<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Encore\Admin\Widgets\Box;
use Illuminate\Support\Facades\DB;
use Encore\Admin\Widgets\Table;
use Encore\Admin\Facades\Admin;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('Dashboard')
            ->description('Description...')
            ->row(Dashboard::title())
            ->row(function (Row $row) {

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::environment());
                });

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::extensions());
                });

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::dependencies());
                });
            });
    }

    public function chart(Content $content)
    {
        return $content
            ->title('Dashboard')
            ->description('Description...')
            ->row(function (Row $row) {

                $row->column(12, function (Column $column) {
                    $sql = "SELECT DATE_FORMAT(created_at, '%d-%m-%Y') as date_appoinment, COUNT(*) as soni FROM books WHERE created_at BETWEEN DATE_SUB(NOW(), INTERVAL 15 DAY) AND NOW() GROUP BY DATE_FORMAT(created_at, '%d-%m-%Y') ORDER BY DATE_FORMAT(created_at, '%d-%m-%Y') DESC";

                    $sql30 = DB::select($sql);
                    $column->append(
                        new Box('Oxirigi 15 kun ichida kiritilgan kitoblar statistikasi',  view('chart.statisadded', compact('sql30')))
                    );
                });
            })
            ->row(function (Row $row) {

                $row->column(4, function (Column $column) {
                    $stat = DB::table('members')->selectRaw('adress, count(*) as soni')->groupBy('adress')->get();
                    $column->append(new Box('Viloyatlar kesimida kitobxonlar',  view('chart.region', compact('stat'))));
                });

                $row->column(4, function (Column $column) {
                    $stat = DB::table('searchkeys')->orderBy('count_using', 'desc')->limit(13)->get();

                    $column->append(new Box('TOP so`rovlar',  view('chart.keyword', compact('stat'))));
                });

                $row->column(4, function (Column $column) {
                    $likeBooks = \App\Models\LikeBooks::orderBy('created_at', 'desc')->limit(13)->get();

                    $column->append(new Box('Eng oxirgi yoqtirilgan kitoblar',  view('chart.appeals', compact('likeBooks'))));
                });
            });
    }

    public function upload(Request $request)
    {
        $param = [
            'uploaded' => 1,
            'fileName' => 'fileName',
            'url' => 'url'
        ];
        $image = $request->file('file'); // get file
        $path = $request->file->store('images');
        if ($request->file()) {
            $fileName = time() . '_' . $request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
            $param['location'] = Storage::url($filePath);
        }
        // response

        return response()->json($param, 200);
    }
}
