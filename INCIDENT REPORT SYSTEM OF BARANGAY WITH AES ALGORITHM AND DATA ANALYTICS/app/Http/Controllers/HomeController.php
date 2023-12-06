<?php

namespace App\Http\Controllers;

use App\Models\Blotter;
use App\Models\CaseHearing;
use App\Models\CourtAction;
use App\Models\Hearing;
use App\Models\Incident_Case;
use App\Models\Notice;
use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    function getStopWords()
    {
        $stopwords = [
            "The", "i", "said", "me", "my", "myself", "we", "our", "ours", "ourselves", "you", "your", "yours", "yourself", "yourselves", "he", "him", "his", "himself", "she", "her", "hers", "herself", "it", "its", "itself", "they", "them", "their", "theirs", "themselves", "what", "which", "who", "whom", "this", "that", "these", "those", "am", "is", "are", "was", "were", "be", "been", "being", "have", "has", "had", "having", "do", "does", "did", "doing", "a", "an", "the", "and", "but", "if", "or", "because", "as", "until", "while", "of", "at", "by", "for", "with", "about", "against", "between", "into", "through", "during", "before", "after", "above", "below", "to", "from", "up", "down", "in", "out", "on", "off", "over", "under", "again", "further", "then", "once", "here", "there", "when", "where", "why", "how", "all", "any", "both", "each", "few", "more", "most", "other", "some", "such", "no", "nor", "not", "only", "own", "same", "so", "than", "too", "very", "s", "t", "can", "will", "just", "don", "should", "now",
            "Manila", "Philippines", "akin", "aking", "ako", "alin", "am", "amin", "aming", "ang", "ano", "anumang", "apat", "at", "atin", "ating", "ay", "bababa", "bago", "bakit", "bawat", "bilang", "dahil", "dalawa", "dapat", "din", "dito", "doon", "gagawin", "gayunman", "ginagawa", "ginawa", "ginawang", "gumawa", "gusto", "habang", "hanggang", "hindi", "huwag", "iba", "ibaba", "ibabaw", "ibig", "ikaw", "ilagay", "ilalim", "ilan", "inyong", "isa", "isang", "itaas", "ito", "iyo", "iyon", "iyong", "ka", "kahit", "kailangan", "kailanman", "kami", "kanila", "kanilang", "kanino", "kanya", "kanyang", "kapag", "kapwa", "karamihan", "katiyakan", "katulad", "kaya", "kaysa", "ko", "kong", "kulang", "kumuha", "kung", "laban", "lahat", "lamang", "likod", "lima", "maaari", "maaaring", "maging", "mahusay", "makita", "marami", "marapat", "masyado", "may", "mayroon", "mga", "minsan", "mismo", "mula", "muli", "na", "nabanggit", "naging", "nagkaroon", "nais", "nakita", "namin", "napaka", "narito", "nasaan", "ng", "ngayon", "ni", "nila", "nilang", "nito", "niya", "niyang", "noon", "o", "pa", "paano", "pababa", "paggawa", "pagitan", "pagkakaroon", "pagkatapos", "palabas", "pamamagitan", "panahon", "pangalawa", "para", "paraan", "pareho", "pataas", "pero", "pumunta", "pumupunta", "sa", "saan", "sabi", "sabihin", "sarili", "sila", "sino", "siya", "tatlo", "tayo", "tulad", "tungkol", "una", "walang"
        ];

        return $stopwords;
    }

    function clean_stopword($string, $stopword)
    {
        $string = preg_replace('/\b(' . implode('|', $stopword) . ')\b/', '', $string);
        $string = trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", $string)));

        return $string;
    }

    public function redirect()
    {
        if (Auth::id()) {
            if (Auth::user()->user_type_id == '1' || Auth::user()->user_type_id == 2) {
                $data = Blotter::select('case_no', 'date_of_incident')->orderBy('date_of_incident')->get()->groupBy(function ($data) {
                    return Carbon::parse($data->date_of_incident)->format('Y-m-d');
                });

                //bar graph
                $months = [];
                $monthCount = [];
                foreach ($data as $month => $values) {
                    $months[] = $month;
                    $monthCount[] = count($values);
                }

                //hearing_type counter
                $hearing_id = [];
                $hearing_type_count = [];
                $case_hearing = DB::select('SELECT * FROM case_hearings WHERE id IN (SELECT MAX(id) FROM case_hearings GROUP BY case_no)');
                foreach ($case_hearing as $ch) {
                    $hearing_id[] = $ch->hearing_id;
                }

                $hearing = Hearing::select('hearing_type_id')->whereIn('hearing_id', $hearing_id)->orderBy('hearing_type_id')->get()->groupBy('hearing_type_id');

                foreach ($hearing as $h => $values) {
                    $hearing_type_count[] = count($values);
                }

                //article no. 
                $articles_of_incidents = Incident_Case::select('article_no', DB::raw('count(*) as total'))->orderBy('total', 'desc')->groupBy('article_no')->get();

                $article_no = [];
                $article_count = [];
                foreach ($articles_of_incidents as $article => $values) {
                    $article_no[] = 'Article No. ' . $values->article_no;
                    $article_count[] = $values->total;
                    $kp_cases1 = DB::table('kp_cases')->where('article_no', $values->article_no)->first(); 
                    $kp_cases[] = $kp_cases1->case_name;       
                    //dd($article_no);      
                }

                //hearing schedule
                $present_sched = Notice::select('notices.case_no', 'date_of_meeting', 'case_title')
                    ->distinct('notices.case_no')
                    ->leftJoin('blotter_report', 'blotter_report.case_no', '=', 'notices.case_no')
                    ->orderby('date_of_meeting', 'desc')
                    ->get();

                $todayCaseTitle = [];
                $todaySchedule = [];

                $tomorrowCaseTitle = [];
                $tomorrowSchedule = [];

                $nextWeekCaseTitle = [];
                $nextWeekSchedule = [];

                $now = Carbon::now()->addWeeks(1);
                $weekStartDate = $now->startOfWeek()->format('Y-m-d');
                $weekEndDate = $now->endOfWeek()->format('Y-m-d');

                foreach ($present_sched as $sched) {
                    $parsedDate = Carbon::parse($sched->date_of_meeting)->format('Y-m-d');
                    if ($parsedDate == Carbon::today()->format('Y-m-d')) {
                        $todayCaseTitle[] = $sched->case_title;
                        $todaySchedule[] =  Carbon::parse($sched->date_of_meeting)->format('F j, Y, h:i A');
                    } else if ($parsedDate == Carbon::tomorrow()->format('Y-m-d')) {
                        $tomorrowCaseTitle[] = $sched->case_title;
                        $tomorrowSchedule[] =  Carbon::parse($sched->date_of_meeting)->format('F j, Y, h:i A');
                    } else if (($parsedDate >= $weekStartDate) && ($parsedDate <= $weekEndDate)) {
                        $nextWeekCaseTitle[] = $sched->case_title;
                        $nextWeekSchedule[] =  Carbon::parse($sched->date_of_meeting)->format('F j, Y, h:i A');
                    }
                }
                $todayCount = count($todaySchedule);
                $tomorrowCount = count($tomorrowSchedule);
                $nextWeekCount = count($nextWeekSchedule);

                //Purok 1
                $report_purok1 = Report::select('street', 'date_of_incident')->where('street', 'Purok 1')->orderBy('date_of_incident')->get()->groupBy(function ($incident_data) {
                    return Carbon::parse($incident_data->date_of_incident)->format('Y-m-d');
                });
                $dates_prk1 = [];
                $dateCount_prk1 = [];
                foreach ($report_purok1 as $date => $values) {
                    $dates_prk1[] = $date;
                    $dateCount_prk1[] = count($values);
                }

                //Purok 2
                $report_purok2 = Report::select('street', 'date_of_incident')->where('street', 'Purok 2')->orderBy('date_of_incident')->get()->groupBy(function ($incident_data) {
                    return Carbon::parse($incident_data->date_of_incident)->format('Y-m-d');
                });
                $dates_prk2 = [];
                $dateCount_prk2 = [];
                foreach ($report_purok2 as $date => $values) {
                    $dates_prk2[] = $date;
                    $dateCount_prk2[] = count($values);
                }

                //Purok 3
                $report_purok3 = Report::select('street', 'date_of_incident')->where('street', 'Purok 3')->orderBy('date_of_incident')->get()->groupBy(function ($incident_data) {
                    return Carbon::parse($incident_data->date_of_incident)->format('Y-m-d');
                });
                $dates_prk3 = [];
                $dateCount_prk3 = [];
                foreach ($report_purok3 as $date => $values) {
                    $dates_prk3[] = $date;
                    $dateCount_prk3[] = count($values);
                }

                //Purok 4
                $report_purok4 = Report::select('street', 'date_of_incident')->where('street', 'Purok 1')->orderBy('date_of_incident')->get()->groupBy(function ($incident_data) {
                    return Carbon::parse($incident_data->date_of_incident)->format('Y-m-d');
                });
                $dates_prk4 = [];
                $dateCount_prk4 = [];
                foreach ($report_purok4 as $date => $values) {
                    $dates_prk4[] = $date;
                    $dateCount_prk4[] = count($values);
                }

                //Purok 5
                $report_purok5 = Report::select('street', 'date_of_incident')->where('street', 'Purok 5')->orderBy('date_of_incident')->get()->groupBy(function ($incident_data) {
                    return Carbon::parse($incident_data->date_of_incident)->format('Y-m-d');
                });
                $dates_prk5 = [];
                $dateCount_prk5 = [];
                foreach ($report_purok5 as $date => $values) {
                    $dates_prk5[] = $date;
                    $dateCount_prk5[] = count($values);
                }

                //Dimson compound
                $report_dimsoncomp = Report::select('street', 'date_of_incident')->where('street', 'Dimson Compound')->orderBy('date_of_incident')->get()->groupBy(function ($incident_data) {
                    return Carbon::parse($incident_data->date_of_incident)->format('Y-m-d');
                });
                $dates_dimson = [];
                $dateCount_dimson = [];
                foreach ($report_dimsoncomp as $date => $values) {
                    $dates_dimson[] = $date;
                    $dateCount_dimson[] = count($values);
                }

                //Purok 7
                $report_purok7 = Report::select('street', 'date_of_incident')->where('street', 'Purok 7')->orderBy('date_of_incident')->get()->groupBy(function ($incident_data) {
                    return Carbon::parse($incident_data->date_of_incident)->format('Y-m-d');
                });
                $dates_prk7 = [];
                $dateCount_prk7 = [];
                foreach ($report_purok7 as $date => $values) {
                    $dates_prk7[] = $date;
                    $dateCount_prk7[] = count($values);
                }

                //Purok 8
                $report_purok8 = Report::select('street', 'date_of_incident')->where('street', 'Purok 8')->orderBy('date_of_incident')->get()->groupBy(function ($incident_data) {
                    return Carbon::parse($incident_data->date_of_incident)->format('Y-m-d');
                });
                $dates_prk8 = [];
                $dateCount_prk8 = [];
                foreach ($report_purok8 as $date => $values) {
                    $dates_prk8[] = $date;
                    $dateCount_prk8[] = count($values);
                }

                //Purok 9
                $report_purok9 = Report::select('street', 'date_of_incident')->where('street', 'Purok 9')->orderBy('date_of_incident')->get()->groupBy(function ($incident_data) {
                    return Carbon::parse($incident_data->date_of_incident)->format('Y-m-d');
                });
                $dates_prk9 = [];
                $dateCount_prk9 = [];
                foreach ($report_purok9 as $date => $values) {
                    $dates_prk9[] = $date;
                    $dateCount_prk9[] = count($values);
                }

                //Sta Teresa
                $report_stateresa = Report::select('street', 'date_of_incident')->where('street', 'Sta Teresa')->orderBy('date_of_incident')->get()->groupBy(function ($incident_data) {
                    return Carbon::parse($incident_data->date_of_incident)->format('Y-m-d');
                });
                $dates_sta = [];
                $dateCount_sta = [];
                foreach ($report_stateresa as $date => $values) {
                    $dates_sta[] = $date;
                    $dateCount_sta[] = count($values);
                }

                //Caldozo Compound
                $report_caldozocomp = Report::select('street', 'date_of_incident')->where('street', 'Caldozo Compound')->orderBy('date_of_incident')->get()->groupBy(function ($incident_data) {
                    return Carbon::parse($incident_data->date_of_incident)->format('Y-m-d');
                });
                $dates_caldozo = [];
                $dateCount_caldozo = [];
                foreach ($report_caldozocomp as $date => $values) {
                    $dates_caldozo[] = $date;
                    $dateCount_caldozo[] = count($values);
                }

                //Perpetual Village
                $report_perpetualvill = Report::select('street', 'date_of_incident')->where('street', 'Perpetual Village')->orderBy('date_of_incident')->get()->groupBy(function ($incident_data) {
                    return Carbon::parse($incident_data->date_of_incident)->format('Y-m-d');
                });
                $dates_perpetual = [];
                $dateCount_perpetual = [];
                foreach ($report_perpetualvill as $date => $values) {
                    $dates_perpetual[] = $date;
                    $dateCount_perpetual[] = count($values);
                }

                // # of report per type
                $report_types = Report::select('type', DB::raw('count(*) as total'))->orderBy('total')->groupBy('type')->take(10)->get();
                //dd($report_types);
                $types = [];
                $typeCount = [];
                foreach ($report_types as $type => $values) {
                    $types[] = $values->type;
                    $typeCount[] = $values->total;
                }

                $report_types2 = Report::select('type',  DB::raw('count(*) as total'))->orderBy('total', 'desc')->groupBy('type')->take(5)->get();
                $types2 = [];
                $typeCount2 = [];
                foreach ($report_types2 as $type2 => $values) {
                    $types2[] = $values->type;
                    $typeCount2[] = $values->total;
                }
                //dd($typeCount2);
                //dd($report_types);

                //dougnut
                $report_count = Report::count();

                //wordcloud
                $blotter = Blotter::select('complaint_desc')->get()->groupBy('complaint_desc');
                $complaint_desc = [];
                foreach ($blotter as $type => $values) {
                    $complaint_desc[] = $type;
                }


                //$str_CD = htmlspecialchars(json_encode($complaint_desc), ENT_QUOTES, "UTF-8");
                $str_CD = json_encode($complaint_desc);
                $stop_words = $this->getStopWords();
                $cleanedText = $this->clean_stopword($str_CD, $stop_words);


                //ongoing blotter cases
                $case_hearing = array();
                $blotter = array();
                $hearings = array();

                $data = Blotter::latest()->get();
                $chs = CaseHearing::latest()->get()->unique('case_no');

                foreach ($data as $d) {
                    if (!$chs->contains('case_no', $d->case_no)) {
                        $blotter[] = Blotter::where('case_no', $d->case_no)->first();
                    }
                }
                foreach ($chs as $c) {
                    $hearings[] = Hearing::where('hearing_id', $c->hearing_id)->first();
                }

                foreach ($hearings as $h) {
                    if (!$h->settlement_id && !$h->award_id) {
                        $case_hearing[] = CaseHearing::where('hearing_id', $h->hearing_id)->first();
                    }
                }

                foreach ($case_hearing as $ch) {
                    $blotter[] = Blotter::where('case_no', $ch->case_no)->latest()->first();
                }

                //blotter
                $currentCountBlotter = Blotter::count();
                $todayCountBlotter = count(Blotter::whereDate('created_at', Carbon::today())->get());
                $weekCountBlotter = count(Blotter::whereBetween('created_at', [Carbon::now()->subWeek()->format("Y-m-d H:i:s"), Carbon::now()])->get());
                $monthCountBlotter = count(Blotter::whereMonth('created_at', Carbon::now()->month)->get());

                //settled cases
                $case_hearing = CaseHearing::all();
                $data = array();
                $hearings = array();

                foreach ($case_hearing as $ch) {
                    $hearings[] = Hearing::where('hearing_id', $ch->hearing_id)->first();
                }

                foreach ($case_hearing as $key => $value) {
                    if ($hearings[$key]->settlement_id || $hearings[$key]->award_id) {
                        $data[] = Blotter::where('blotter_report.case_no', $value->case_no)->first();
                    }
                }
                $settledCases = count($data);
                $unsettledCases = count($blotter);
                $courtAction = count(CourtAction::get());


                //HEARINGS
                //med
                $mediation_hearing = array();
$blotter_report_med = array();

$all_case_hearing = DB::select('SELECT * FROM case_hearings WHERE id IN (SELECT MAX(id) FROM case_hearings GROUP BY case_no)');

foreach ($all_case_hearing as $ch) {
    $mediation = Hearing::where('hearing_id', $ch->hearing_id)->where('hearing_type_id', 1)->whereNull('settlement_id')->first();
    if ($mediation) {
        $mediation_hearing[] = $mediation;
    }
}

foreach ($mediation_hearing as $mediation) {
    $case = CaseHearing::where('hearing_id', $mediation->hearing_id)->first();
    if ($case) {
        $court_action = CourtAction::where('case_no', $case->case_no)->first();
        if (!$court_action) {
            $blotter = Blotter::where('case_no', $case->case_no)->first();
            if ($blotter) {
                $blotter_report_med[] = $blotter;
            }
        }
    }
}

// Similar process for conciliation hearings

$conciliation_hearing = array();
$blotter_report_con = array();

$all_case_hearing = DB::select('SELECT * FROM case_hearings WHERE id IN (SELECT MAX(id) FROM case_hearings GROUP BY case_no)');

foreach ($all_case_hearing as $ch) {
    $conciliation = Hearing::where('hearing_id', $ch->hearing_id)->where('hearing_type_id', 2)->whereNull('settlement_id')->first();
    if ($conciliation) {
        $conciliation_hearing[] = $conciliation;
    }
}

foreach ($conciliation_hearing as $conciliation) {
    $case = CaseHearing::where('hearing_id', $conciliation->hearing_id)->first();
    if ($case) {
        $court_action = CourtAction::where('case_no', $case->case_no)->first();
        if (!$court_action) {
            $blotter = Blotter::where('case_no', $case->case_no)->first();
            if ($blotter) {
                $blotter_report_con[] = $blotter;
            }
        }
    }
}



$arbitration_hearing = Hearing::where('hearing_type_id', 3)->whereNull('award_id')->get();
$blotter_report_arb = array();

foreach ($arbitration_hearing as $arbitration) {
    $case_hearing = CaseHearing::where('hearing_id', $arbitration->hearing_id)->first();

    // Check if $case_hearing is not null before accessing its properties
    if ($case_hearing) {
        $court_action = CourtAction::where('case_no', $case_hearing->case_no)->first();
        
        if (!$court_action) {
            $blotter = Blotter::where('case_no', $case_hearing->case_no)->first();
            
            // Check if $blotter is not null before adding it to the array
            if ($blotter) {
                $blotter_report_arb[] = $blotter;
            }
        }
    }
}

//mediationCount
$mediationCount = count($blotter_report_med);
//conciliationCount
$conciliationCount = count($blotter_report_con);
//arbitrationCount
$arbitrationCount = count($blotter_report_arb);

                //incident reports
                $currentCountIncident = Report::count();
                $todayCountIncident = count(Report::whereDate('created_at', Carbon::today())->get());
                $weekCountIncident = count(Report::whereBetween('created_at', [Carbon::now()->subWeek()->format("Y-m-d H:i:s"), Carbon::now()])->get());
                $monthCountIncident = count(Report::whereMonth('created_at', Carbon::now()->month)->get());

                $matrixAll = Report::select(
                    'street',
                    DB::raw('SUM(if(MONTH(date_of_incident) = 1, 1,0)) as Jan'),
                    DB::raw('SUM(if(MONTH(date_of_incident) = 2, 1,0)) as Feb'),
                    DB::raw('SUM(if(MONTH(date_of_incident) = 3, 1,0)) as Mar'),
                    DB::raw('SUM(if(MONTH(date_of_incident) = 4, 1,0)) as Apr'),
                    DB::raw('SUM(if(MONTH(date_of_incident) = 5, 1,0)) as May'),
                    DB::raw('SUM(if(MONTH(date_of_incident) = 6, 1,0)) as Jun'),
                    DB::raw('SUM(if(MONTH(date_of_incident) = 7, 1,0)) as Jul'),
                    DB::raw('SUM(if(MONTH(date_of_incident) = 8, 1,0)) as Aug'),
                    DB::raw('SUM(if(MONTH(date_of_incident) = 9, 1,0)) as Sep'),
                    DB::raw('SUM(if(MONTH(date_of_incident) = 10, 1,0)) as Oct'),
                    DB::raw('SUM(if(MONTH(date_of_incident) = 11, 1,0)) as Nov'),
                    DB::raw('SUM(if(MONTH(date_of_incident) = 12, 1,0)) as `Dec`'),
                )
                    ->whereYear('created_at', Carbon::now()->year)
                    ->groupBy('street')
                    ->get();
                //dd($matrixAll);

                $incidentCount = [];
                $streetY = [];
                $monthX = [];


                foreach ($matrixAll as $key => $value) {
                    for ($i = 1; $i <= 12; $i++) {
                        $monthX[] = $i;
                        $streetY[] = $key + 1;
                        switch ($monthX[$i - 1]) {
                            case 1:
                                $incidentCount[] = $value->Jan;
                                break;
                            case 2:
                                $incidentCount[] = $value->Feb;
                                break;
                            case 3:
                                $incidentCount[] = $value->Mar;
                                break;
                            case 4:
                                $incidentCount[] = $value->Apr;
                                break;
                            case 5:
                                $incidentCount[] = $value->May;
                                break;
                            case 6:
                                $incidentCount[] = $value->Jun;
                                break;
                            case 7:
                                $incidentCount[] = $value->Jul;
                                break;
                            case 8:
                                $incidentCount[] = $value->Aug;
                                break;
                            case 9:
                                $incidentCount[] = $value->Sep;
                                break;
                            case 10:
                                $incidentCount[] = $value->Oct;
                                break;
                            case 11:
                                $incidentCount[] = $value->Nov;
                                break;
                            case 12:
                                $incidentCount[] = $value->Dec;
                                break;
                            default:
                        }
                    }
                }

                //article no. 
                $articles_of_incidents = Incident_Case::select('article_no', DB::raw('count(*) as total'))->orderBy('total', 'desc')->groupBy('article_no')->get();

                $article_no = [];
                $article_count = [];
                foreach ($articles_of_incidents as $article => $values) {
                    $article_no[] = 'Article No. ' . $values->article_no;
                    $article_count[] = $values->total;
                }

                //top incident report per street
                $top_incident_street = Report::select('street', 'type', DB::raw('count(*) as total'))->groupBy('street', 'type')->orderBy('total', 'desc')->get()->unique('street');
                //dd($top_incident_street);
                $street = [];
                $type = [];
                $type_count = [];
                foreach ($top_incident_street as $tis) {
                    $street[] = $tis->street;
                    $type[] = $tis->type;
                    $type_count[] = $tis->total;
                }

                //
                $incidentPerMonth = Report::select(

                    DB::raw('SUM(if(MONTH(date_of_incident) = 1, 1,0)) as Jan'),
                    DB::raw('SUM(if(MONTH(date_of_incident) = 2, 1,0)) as Feb'),
                    DB::raw('SUM(if(MONTH(date_of_incident) = 3, 1,0)) as Mar'),
                    DB::raw('SUM(if(MONTH(date_of_incident) = 4, 1,0)) as Apr'),
                    DB::raw('SUM(if(MONTH(date_of_incident) = 5, 1,0)) as May'),
                    DB::raw('SUM(if(MONTH(date_of_incident) = 6, 1,0)) as Jun'),
                    DB::raw('SUM(if(MONTH(date_of_incident) = 7, 1,0)) as Jul'),
                    DB::raw('SUM(if(MONTH(date_of_incident) = 8, 1,0)) as Aug'),
                    DB::raw('SUM(if(MONTH(date_of_incident) = 9, 1,0)) as Sep'),
                    DB::raw('SUM(if(MONTH(date_of_incident) = 10, 1,0)) as Oct'),
                    DB::raw('SUM(if(MONTH(date_of_incident) = 11, 1,0)) as Nov'),
                    DB::raw('SUM(if(MONTH(date_of_incident) = 12, 1,0)) as `Dec`'),
                )
                    ->whereYear('created_at', Carbon::now()->year)

                    ->get();

                $incidentCount2 = [];
                foreach ($incidentPerMonth as $iPM) {
                    for ($i = 1; $i <= 12; $i++) {
                        $monthIPM[] = $i;
                        switch ($monthIPM[$i - 1]) {
                            case 1:
                                $incidentCount2[] = $iPM->Jan;
                                break;
                            case 2:
                                $incidentCount2[] = $iPM->Feb;
                                break;
                            case 3:
                                $incidentCount2[] = $iPM->Mar;
                                break;
                            case 4:
                                $incidentCount2[] = $iPM->Apr;
                                break;
                            case 5:
                                $incidentCount2[] = $iPM->May;
                                break;
                            case 6:
                                $incidentCount2[] = $iPM->Jun;
                                break;
                            case 7:
                                $incidentCount2[] = $iPM->Jul;
                                break;
                            case 8:
                                $incidentCount2[] = $iPM->Aug;
                                break;
                            case 9:
                                $incidentCount2[] = $iPM->Sep;
                                break;
                            case 10:
                                $incidentCount2[] = $iPM->Oct;
                                break;
                            case 11:
                                $incidentCount2[] = $iPM->Nov;
                                break;
                            case 12:
                                $incidentCount2[] = $iPM->Dec;
                                break;
                            default:
                        }
                    }
                }

                $total_incident_street = Report::select('street', DB::raw('count(*) as total'))->groupBy('street')->orderBy('street', 'asc')->get();
                //dd($total_incident_street);

                return view('admin.home', [
                    'data' => $data,
                    'months' => $months,
                    'monthCount' => $monthCount,
                    'dates_prk1' => $dates_prk1,
                    'dateCount_prk1' => $dateCount_prk1,
                    'dates_prk2' => $dates_prk2,
                    'dateCount_prk2' => $dateCount_prk2,
                    'dates_prk3' => $dates_prk3,
                    'dateCount_prk3' => $dateCount_prk3,
                    'dates_prk4' => $dates_prk4,
                    'dateCount_prk4' => $dateCount_prk4,
                    'dates_prk5' => $dates_prk5,
                    'dateCount_prk5' => $dateCount_prk5,
                    'dates_dimson' => $dates_dimson,
                    'dateCount_dimson' => $dateCount_dimson,
                    'dates_prk7' => $dates_prk7,
                    'dateCount_prk7' => $dateCount_prk7,
                    'dates_prk8' => $dates_prk8,
                    'dateCount_prk8' => $dateCount_prk8,
                    'dates_prk9' => $dates_prk9,
                    'dateCount_prk9' => $dateCount_prk9,
                    'dates_sta' => $dates_sta,
                    'dateCount_sta' => $dateCount_sta,
                    'dates_caldozo' => $dates_caldozo,
                    'dateCount_caldozo' => $dateCount_caldozo,
                    'dates_perpetual' => $dates_perpetual,
                    'dateCount_perpetual' => $dateCount_perpetual,
                    'types' => $types,
                    'typeCount' => $typeCount,
                    'types2' => $types2,
                    'typeCount2' => $typeCount2,
                    'report_count' => $report_count,
                    'complaint_desc' => $complaint_desc,
                    'cleanedText' => $cleanedText,
                    'currentCountBlotter' => $currentCountBlotter,
                    'todayCountBlotter' => $todayCountBlotter,
                    'weekCountBlotter' => $weekCountBlotter,
                    'monthCountBlotter' => $monthCountBlotter,
                    'currentCountIncident' => $currentCountIncident,
                    'todayCountIncident' => $todayCountIncident,
                    'weekCountIncident' => $weekCountIncident,
                    'monthCountIncident' => $monthCountIncident,
                    'settledCases' => $settledCases,
                    'unsettledCases' => $unsettledCases,
                    'courtAction' => $courtAction,
                    'mediationCount' => $mediationCount,
                    'conciliationCount' => $conciliationCount,
                    'arbitrationCount' => $arbitrationCount,
                    'hearing_type_count' => $hearing_type_count,
                    'article_no' => $article_no,
                    'article_count' => $article_count,
                    'kp_cases' => $kp_cases,

                    'todayCaseTitle' => $todayCaseTitle,
                    'todaySchedule' => $todaySchedule,
                    'todayCount' => $todayCount,

                    'tomorrowCaseTitle' => $tomorrowCaseTitle,
                    'tomorrowSchedule' => $tomorrowSchedule,
                    'tomorrowCount' => $tomorrowCount,

                    'nextWeekCaseTitle' => $nextWeekCaseTitle,
                    'nextWeekSchedule' => $nextWeekSchedule,
                    'nextWeekCount' => $nextWeekCount,

                    'incidentCount' => $incidentCount,
                    'streetY' => $streetY,
                    'monthX' => $monthX,

                    'incidentCount2' => $incidentCount2,
                    'monthIPM' => $monthIPM,

                    'total_incident_street' => $total_incident_street,
                ]);
            } else {
                return view('user.home');
            }
        } else {
            return redirect()->back();
        }
    }

    public function index()
    {
        

        return view('user.home');
    }

    public function user_manual()
    {
        if (Auth::id()) {
            if (Auth::user()->user_type_id == 1 || Auth::user()->user_type_id == 2) {

                return view('admin.user_manual');
            } else {
                return redirect()->back();
            }
        } else {
            return redirect('login');
        }
    }
}
