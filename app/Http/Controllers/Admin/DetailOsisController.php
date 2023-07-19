<?php

namespace App\Http\Controllers\Admin;

use App\Models\Calon;
use App\Models\Polling;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DetailOsisController extends Controller
{
    public function index(string $id)
    {
        $kandidat = Calon::whereId($id)->WhereYear('created_at', date('Y'))->where('status_polling', 1)->first();

        $team_a = Calon::join('pollings', 'pollings.calon_id', 'calons.id')->WhereYear('calons.created_at', date('Y'))->where('calons.status_polling', 1)->where('calons.team', 'Team A')->get();
        $team_b = Calon::join('pollings', 'pollings.calon_id', 'calons.id')->WhereYear('calons.created_at', date('Y'))->where('calons.status_polling', 1)->where('calons.team', 'Team B')->get();
        $team_c = Calon::join('pollings', 'pollings.calon_id', 'calons.id')->WhereYear('calons.created_at', date('Y'))->where('calons.status_polling', 1)->where('calons.team', 'Team C')->get();
        $team_d = Calon::join('pollings', 'pollings.calon_id', 'calons.id')->WhereYear('calons.created_at', date('Y'))->where('calons.status_polling', 1)->where('calons.team', 'Team D')->get();
        $team_e = Calon::join('pollings', 'pollings.calon_id', 'calons.id')->WhereYear('calons.created_at', date('Y'))->where('calons.status_polling', 1)->where('calons.team', 'Team E')->get();

        $total_team_a = count($team_a);
        $total_team_b = count($team_b);
        $total_team_c = count($team_c);
        $total_team_d = count($team_d);
        $total_team_e = count($team_e);

        return view('admin.pages.detail-osis', compact(
            'kandidat',
            'total_team_a',
            'total_team_b',
            'total_team_c',
            'total_team_d',
            'total_team_e',
        ));
    }
}
