<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\DamageType;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Milestone;
use App\Models\Report;
use App\Models\ThisCase;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ManagerHotTopicController extends Controller
{
    public function clearSelectedLaporans()
    {
        session()->forget('finselectedIds');
        return redirect()->route('manager.laporan_belum_unggah');
    }

    public function viewSelectedLaporans(Request $request)
    {
        // convert string input to array
        $finselectedIds = explode(',', $request->input('reports'));

        // filter valid ID(?)
        $finselectedIds = array_filter($finselectedIds, function ($id) {
            return is_numeric($id);
        });

        $selectedLaporans = Report::whereIn('id', $finselectedIds)->paginate(7);
        $selectedCount = count($selectedLaporans);
        return view('manager.unggah_kasus.unggah_1', ['selectedLaporans' => $selectedLaporans, 'selectedCount' => $selectedCount]);
    }

    public function dropdownData()
    {
        $datas = [
            'damage_type' => DamageType::all(),
            'kelurahan' => Kelurahan::all(),
            'kecamatan' => Kecamatan::all(),
            'milestone' => Milestone::all(),
        ];
        return $datas;
    }

    public function dropdown_unggah()
    {
        $datas = $this->dropdownData();
        return view('manager.unggah_kasus.scroll.isi_kasus', ['datas' => $datas]);
    }


    public function storeHotTopic(Request $request)
    {
        // dump($request->all());
        // dd($request);
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'address' => 'required|string',
            'kelurahan' => 'required|string',
            'damage_type' => 'required|string',
        ]);

        $request->merge(['case_number' => bin2hex(random_bytes(40))]);

        $damage_type_id = DamageType::where('name', $request->input('damage_type'))->first()->id;
        $request->merge(['damage_type' => $damage_type_id]);

        $kelurahan_id = Kelurahan::where('name', $request->input('kelurahan'))->first()->id;
        $request->merge(['kelurahan' => $kelurahan_id]);

        $government_id = User::where('role', 'government')->inRandomOrder()->first()->id;

        $user_id = User::where('role', 'manager')->inRandomOrder()->first()->id;

        // dd($government_id);

        $data = ([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'address' => $request->input('address'),
            'kelurahan_id' => $kelurahan_id,
            'damage_type_id' => $damage_type_id,
            'status' => 0,
            'case_number' => $request->input('case_number'),
            'government_id' => $government_id,
            // 'created_by' => Auth::user()->id,
            'created_by' => $user_id
        ]);

        $temp = ThisCase::create($data);
        // dump($temp);

        $reports = $request->input('reports');
        $reports = explode(',', $reports);
        // dump($reports);

        foreach ($reports as $report) {

            $report = Report::find($report);
            // dump($report);
            continue;
            $report->case_id = $temp->id;
            foreach ($report->images as $image) {
                $image->case_id = $temp->id;
                $image->save();
            }
            $report->save();
        }

        return redirect()->route('manager.hot_topic');
    }

    public function viewSelectedReports(Request $request)
    {
        // convert string input to array
        $finselectedIds = explode(',', $request->input('reports'));

        // filter valid ID(?)
        $finselectedIds = array_filter($finselectedIds, function ($id) {
            return is_numeric($id);
        });

        $selectedLaporans = Report::whereIn('id', $finselectedIds)->paginate(5);
        $selectedCount = count($selectedLaporans);

        $hot_topics = ThisCase::all();
        return view('manager.tambah_kasus.tambah_1', ['selectedLaporans' => $selectedLaporans, 'selectedCount' => $selectedCount, 'hot_topics' => $hot_topics]);
    }

    public function dropdownHotTopic()
    {
        $datas = ThisCase::all();
        return $datas;
    }

    public function update_case_id(Request $request)
    {
        $hot_topic_selected = $request->input('report_selected');
        $reports = $request->input('reports');
        $reports = explode(',', $reports);
        // dd($request->all());
        // dd($reports);
        foreach ($reports as $report) {
            $report = Report::find($report);
            $report->case_id = $hot_topic_selected;
            $report->save();
        }

        return redirect()->route('manager.hot_topic');
    }

    public function editHotTopic(ThisCase $case)
    {
        $damage_type = DamageType::find($case->damage_type_id);
        $damage_type_title = $damage_type ? $damage_type->name : '';
        $case->damage_type_title = $damage_type_title;

        $kelurahan = Kelurahan::find($case->kelurahan_id);
        $kelurahan_title = $kelurahan ? $kelurahan->name : '';
        $case->kelurahan_title = $kelurahan_title;

        if ($case->status == 0) {
            $status_title = "Baru Dilaporkan";
        } else {
            $status = Milestone::find($case->status_id);
            $status_title = $status ? $status->name : '';
        }
        $case->status_title = $status_title;

        // dd($case);

        $datas = $this->dropdownData();

        return view('manager.hot_topic.edit.edit_1', ['case' => $case, 'datas' => $datas]);
    }

    public function showRingkasan(ThisCase $case, Request $request)
    {
        $damage_type_id = DamageType::where('name', $request->input('damage_type'))->first()->id;
        $request->merge(['damage_type' => $damage_type_id]);

        $kelurahan_id = Kelurahan::where('name', $request->input('kelurahan'))->first()->id;
        $request->merge(['kelurahan' => $kelurahan_id]);

        $status_id = Milestone::where('title', $request->input('status'))->first()->id;
        $request->merge(['status' => $status_id]);

        $damage_type = DamageType::find($request->damage_type);
        $damage_type_title = $damage_type ? $damage_type->name : '';

        $kelurahan = Kelurahan::find($request->kelurahan);
        $kelurahan_title = $kelurahan ? $kelurahan->name : '';

        if ($request->status == 0) {
            $status_title = "Baru Dilaporkan";
        } else {
            $status = Milestone::find($request->status);
            $status_title = $status ? $status->title : '';
        }
        $case->status_title = $status_title;

        $data = ([
            'title' => $request->title,
            'description' => $request->description,
            'address' => $request->address,
            'kelurahan' => $kelurahan_title,
            'damage_type' => $damage_type_title,
            'status' => $status_title,
            'kelurahan_id' => $kelurahan_id,
            'damage_type_id' => $damage_type_id,
            'status_id' => $status_id
        ]);

        // dd($case);
        // dd($request);
        // dd($data);

        return view('manager.hot_topic.edit.edit_2', ['case' => $case, 'data' => $data]);
    }

    public function updateHotTopic(Request $request, ThisCase $case)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'address' => 'required|string',
            'kelurahan' => 'required|string',
            'damage_type' => 'required|string',
            'status' => 'required|string'
        ]);

        $case->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'address' => $request->input('address'),
            'kelurahan_id' => $request->input('kelurahan'),
            'damage_type_id' => $request->input('damage_type'),
            'status' => $request->input('status')
        ]);


        return redirect()->route('manager.hot_topic');
    }
}
