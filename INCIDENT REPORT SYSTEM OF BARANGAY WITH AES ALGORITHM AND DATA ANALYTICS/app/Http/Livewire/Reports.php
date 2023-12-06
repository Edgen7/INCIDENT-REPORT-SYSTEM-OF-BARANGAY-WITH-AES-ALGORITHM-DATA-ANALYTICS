<?php

namespace App\Http\Livewire;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Yajra\DataTables\DataTables;

class Reports extends Component
{
    public function render()
    {
        return view('livewire.reports');
    }

    public function create()
    {

          //top 5 incident purok 1
          $top_incident_purok1 = Report::select('type', DB::raw('count(*) as total'))->where('street', 'Purok 1')->groupBy('type')->take(5)->orderBy('total', 'desc')->get();
          $type_PRK1 = [];
          $type_count_PRK1 = [];
          foreach ($top_incident_purok1 as $street) {
              $type_PRK1[] = $street->type;
              $type_count_PRK1[] = $street->total;
          }
  
          //top 5 incident purok 2
          $top_incident_purok2 = Report::select('type', DB::raw('count(*) as total'))->where('street', 'Purok 2')->groupBy('type')->take(5)->orderBy('total', 'desc')->get();
          $type_PRK2 = [];
          $type_count_PRK2 = [];
          foreach ($top_incident_purok2 as $street) {
              $type_PRK2[] = $street->type;
              $type_count_PRK2[] = $street->total;
          }
  
          //top 5 incident purok 3
          $top_incident_purok3 = Report::select('type', DB::raw('count(*) as total'))->where('street', 'Purok 3')->groupBy('type')->take(5)->orderBy('total', 'desc')->get();
          $type_PRK3 = [];
          $type_count_PRK3 = [];
          foreach ($top_incident_purok3 as $street) {
              $type_PRK3[] = $street->type;
              $type_count_PRK3[] = $street->total;
          }
  
          //top 5 incident purok 4
          $top_incident_purok4 = Report::select('type', DB::raw('count(*) as total'))->where('street', 'Purok 4')->groupBy('type')->take(5)->orderBy('total', 'desc')->get();
          $type_PRK4 = [];
          $type_count_PRK4 = [];
          foreach ($top_incident_purok4 as $street) {
              $type_PRK4[] = $street->type;
              $type_count_PRK4[] = $street->total;
          }
  
          //top 5 incident purok 5
          $top_incident_purok5 = Report::select('type', DB::raw('count(*) as total'))->where('street', 'Purok 5')->groupBy('type')->take(5)->orderBy('total', 'desc')->get();
          $type_PRK5 = [];
          $type_count_PRK5 = [];
          foreach ($top_incident_purok5 as $street) {
              $type_PRK5[] = $street->type;
              $type_count_PRK5[] = $street->total;
          }
  
          //top 5 incident dimson compound
          $top_incident_dimsoncomp = Report::select('type', DB::raw('count(*) as total'))->where('street', 'Dimson Compound')->groupBy('type')->take(5)->orderBy('total', 'desc')->get();
          $type_DIMSON = [];
          $type_count_DIMSON = [];
          foreach ($top_incident_dimsoncomp as $street) {
              $type_DIMSON[] = $street->type;
              $type_count_DIMSON[] = $street->total;
          }
  
          //top 5 incident purok 7
          $top_incident_purok7 = Report::select('type', DB::raw('count(*) as total'))->where('street', 'Purok 7')->groupBy('type')->take(5)->orderBy('total', 'desc')->get();
          $type_PRK7 = [];
          $type_count_PRK7 = [];
          foreach ($top_incident_purok7 as $street) {
              $type_PRK7[] = $street->type;
              $type_count_PRK7[] = $street->total;
          }
  
          //top 5 incident purok 8
          $top_incident_purok8 = Report::select('type', DB::raw('count(*) as total'))->where('street', 'Purok 8')->groupBy('type')->take(5)->orderBy('total', 'desc')->get();
          $type_PRK8 = [];
          $type_count_PRK8 = [];
          foreach ($top_incident_purok8 as $street) {
              $type_PRK8[] = $street->type;
              $type_count_PRK8[] = $street->total;
          }
  
          //top 5 incident purok 9
          $top_incident_purok9 = Report::select('type', DB::raw('count(*) as total'))->where('street', 'Purok 9')->groupBy('type')->take(5)->orderBy('total', 'desc')->get();
          $type_PRK9 = [];
          $type_count_PRK9 = [];
          foreach ($top_incident_purok9 as $street) {
              $type_PRK9[] = $street->type;
              $type_count_PRK9[] = $street->total;
          }
  
          //top 5 incident sta teresa
          $top_incident_stateresa = Report::select('type', DB::raw('count(*) as total'))->where('street', 'Sta Teresa')->groupBy('type')->take(5)->orderBy('total', 'desc')->get();
          $type_STA = [];
          $type_count_STA = [];
          foreach ($top_incident_stateresa as $street) {
              $type_STA[] = $street->type;
              $type_count_STA[] = $street->total;
          }
  
          //top 5 incident caldozo compound
          $top_incident_caldozocomp = Report::select('type', DB::raw('count(*) as total'))->where('street', 'Caldozo Compound')->groupBy('type')->take(5)->orderBy('total', 'desc')->get();
          $type_CALDOZO = [];
          $type_count_CALDOZO = [];
          foreach ($top_incident_caldozocomp as $street) {
              $type_CALDOZO[] = $street->type;
              $type_count_CALDOZO[] = $street->total;
          }
  
          //top 5 incident perpetual village
          $top_incident_perpetualvill = Report::select('type', DB::raw('count(*) as total'))->where('street', 'Perpetual VIllage')->groupBy('type')->take(5)->orderBy('total', 'desc')->get();
          $type_PERPETUAL = [];
          $type_count_PERPETUAL = [];
          foreach ($top_incident_perpetualvill as $street) {
              $type_PERPETUAL[] = $street->type;
              $type_count_PERPETUAL[] = $street->total;
          }
  
          $total_incident_street = Report::select('street', DB::raw('count(*) as total'))->groupBy('street')->orderBy('street', 'asc')->get();
          //dd($total_incident_street);
  
          return view('user.report', [
              'type_PRK1' => $type_PRK1,
              'type_count_PRK1' => $type_count_PRK1,
  
              'type_PRK2' => $type_PRK2,
              'type_count_PRK2' => $type_count_PRK2,
  
              'type_PRK3' => $type_PRK3,
              'type_count_PRK3' => $type_count_PRK3,
  
              'type_PRK4' => $type_PRK4,
              'type_count_PRK4' => $type_count_PRK4,
  
              'type_PRK5' => $type_PRK5,
              'type_count_PRK5' => $type_count_PRK5,
  
              'type_DIMSON' => $type_DIMSON,
              'type_count_DIMSON' => $type_count_DIMSON,
  
              'type_PRK7' => $type_PRK7,
              'type_count_PRK7' => $type_count_PRK7,
  
              'type_PRK8' => $type_PRK8,
              'type_count_PRK8' => $type_count_PRK8,
  
              'type_PRK9' => $type_PRK9,
              'type_count_PRK9' => $type_count_PRK9,
  
              'type_STA' => $type_STA,
              'type_count_STA' => $type_count_STA,
  
              'type_CALDOZO' => $type_CALDOZO,
              'type_count_CALDOZO' => $type_count_CALDOZO,
  
              'type_PERPETUAL' => $type_PERPETUAL,
              'type_count_PERPETUAL' => $type_count_PERPETUAL,
  
              'total_incident_street' => $total_incident_street,
          ]);
      }

    public function store(Request $request)
    {

        $request->validate([

            'date_of_incident' => 'required',
            'location' => 'required',
            'persons' => 'required',
            'narrative' => 'required',

        ], []);

        $report = new Report();
        $report->type = $request->type;
        $report->date_of_incident = $request->date_of_incident;
        $report->street = $request->street;
        $report->location = $request->location;
        $report->persons = $request->persons;
        $report->narrative = $request->narrative;
        $report->created_at = date("Y-m-d");

        $report->save();
        return back()->with('success', '');
    }

    public function show()
    {
        if (Auth::id()) {
            if (Auth::user()->user_type_id == 1 || Auth::user()->user_type_id == 2) {
                //$data = Reports::get();
                //$data = DB::select('SELECT * FROM reports');
                //dd($data);
                return view('user.show');
            } else {
                return redirect()->back();
            }
        } else {
            return redirect('login');
        }
    }

    public function edit($id, Request $request)
    {
        if (Auth::id()) {
            if (Auth::user()->user_type_id == 1 || Auth::user()->user_type_id == 2) {
                /**
                $request->validate([
                    'date_of_incident' => 'required',
                    'location' => 'required|max:255|regex:/^[\pL\s\-]+$/u',
                    'persons' => 'required|max:255|regex:/^[\pL\s\-]+$/u',
                    'narrative' => 'required',

                    'remarks' => 'required|max:255|regex:/^[\pL\s\-]+$/u',
                ], [
                    //custom error message here if ever meron
                ]);
                 */

                $report = Report::find($id);


                //$report->type = $request->type;
                //$report->date_of_incident = $request->date_of_incident;
                //$report->location = $request->location;
                //$report->persons = $request->persons;
                //$report->narrative = $request->narrative;
                $report->remarks = $request->remarks;
                $report->status = $request->status;
                $report->save();

                return redirect()->back()->with('updated', '');
            } else {
                return redirect()->back();
            }
        } else {
            return redirect('login');
        }
    }


    public function getIncidentReports(Request $request)
    {
        if ($request->ajax()) {
            //$data = Reports::latest()->get();
            $data = Report::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()

                ->addColumn('action', function ($row) {
                    $link = '<a href="" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#editModal' . $row->id . '"><i class="bi bi-pen"></i> Edit</a>';
                    $modal = '<!-- Modal -->
                    <form method="post" action="' . route('report.update', $row->id) . '" enctype="multipart/form-data">
                    
                    <input type="hidden" name="_token" value="' . csrf_token() . '" />

                    <div class="modal fade" id="editModal' . $row->id . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Incident #' . $row->id . '</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                
                                <div class="modal-body">

                                    <div class="mb-3" id="textboxDiv">
                                        <div class="mb-3">
                                            <label for="remarks" class="form-label">Remarks</label>
                                            <textarea  class="form-control shadow-none  @error("remarks") is-invalid @enderror" value="' . old('persons') . '" name="remarks" id="remarks" required placeholder="Describe yourself here..."> ' . old("persons") . '</textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="status" class="form-label">Status</label>
                                            <select class="form-select shadow-none  @error("status") is-invalid @enderror" name="status" id="status" required>
                                                <option value="PENDING">PENDING</option>
                                                <option value="ON-GOING">ON-GOING</option>
                                                <option value="COMPLETED">COMPLETED</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>';
                    return $link . $modal;
                })
                ->editColumn('type', function ($row) {
                    $type = '<span class="badge rounded-pills bg-primary">' . $row->type . '</span>';
                    return  $type;
                })
                ->editColumn('date_of_incident', function ($row) {
                    $strdate = date('F d, Y, h:i A', strtotime($row->date_of_incident));
                    return  $strdate;
                })
                ->editColumn('status', function ($row) {
                    $status = '<span class="badge rounded-pills bg-warning">' . $row->status . '</span>';
                    return  $status;
                })
                ->rawColumns(['action', 'type', 'status'])
                ->make(true);
        }
    }

    public function feedbacks_show()
    {
        if (Auth::id()) {
            if (Auth::user()->user_type_id == 1 || 2) {

                return view('admin.feedbacks');
            } else {
                return redirect()->back();
            }
        } else {
            return redirect('login');
        }
    }

    public function getFeedbacks(Request $request)
    {
        if ($request->ajax()) {
            $feedbacks = DB::table('contact_forms')->get();

            return Datatables::of($feedbacks)
                ->addIndexColumn()
                ->make(true);
        }
    }
}
