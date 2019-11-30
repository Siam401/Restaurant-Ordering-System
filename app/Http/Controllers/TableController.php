<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function index(){
        // $data=DB::table('mnwv2.monitorevents')->where('quarterly','=',$quaterly)->('area_id','=',$area_id)->get();

        $data = DB::table('mnwv2.monitorevents')->where('quarterly', '=', '2nd')->where('area_id', '=', 118)->get();
        // dd($data);
        foreach($data as $row){
            // dd($row->id);
            $tabledata=DB::table('mnwv2.cal_section_point')->where('event_id', '=', $row->id )->where('section', '=', 1 )->orderBy('sub_id', 'asc')->get();
            // dd($tabledata);
        }

        $sectionsdata = DB::select(DB::raw("SELECT CONCAT(section,'.', sub_id) AS si,string_agg
                    (DISTINCT CONCAT( branchcode, ':', point), ',')  as  brands, section, sub_id, question_point as fullmark FROM mnwv2.cal_section_point WHERE event_id IN(SELECT id FROM mnwv2.monitorevents WHERE area_id='118' and quarterly='2nd') GROUP BY section,sub_id,question_point,branchcode,si"));
        foreach ($sectionsdata as $rw) 
        {
        //   dd($rw);
        //   $data[$rw->si]['fullmark'] = $rw->fullmark;
        //   $data[$rw->si]['section'] = $rw->section;
        //   $tmp = explode(",", $rw->brands);
        //   dd($tmp);


        $tmp1 = explode(".", $rw->si);
        $section = $tmp1[0];
        $qestion = $tmp1[1];
        $tmp2 = explode(":", $rw->brands);
        $branch = $tmp2[0];
        $point = $tmp2[1];
        $query=DB::select(DB::raw("SELECT * FROM mnwv2.cal_section_point where branchcode='1834' and section=1"));
        dd($branch);

        //   foreach ($tmp as $key => $value) 
        //   {
            // $tmp2 = explode(":", $value);
            // $tmp0 = $tmp2[0];
            // $tmp1 = $tmp2[1];
            // $data[$rw->si]['branchs'][$tmp0] = $tmp1;
        //   }
          /*$data[$values['si']]['fullmark'] = $values['fullmark'];
          $data[$values['si']]['section'] = $values['section'];     
          $tmp = explode(",", $values['brands']);
          foreach ($tmp as $key => $value) {
              $tmp2 = explode(":", $value);
              $data[$values['si']]['branchs'][$tmp2[0]] = $tmp2[1];
          }*/
        }            
        
        return view('table',compact('data'));




        //   $year ='2019';
        //   $quarterly ='2nd';
        //   $area='118';
        //   $results= [];
        //   $data = [];
        //   $branchs = [];
          
        //   $query=DB::select(DB::raw("SELECT * FROM mnwv2.monitorevents WHERE area_id='$area' and  year='$year' and quarterly='$quarterly'"));
        //     foreach ($query as $row) 
        //     {
        //      $results[] = $row->id;
        //     }
        //     $brnch = DB::select(DB::raw("SELECT DISTINCT branchcode FROM mnwv2.cal_section_point WHERE event_id IN(SELECT id FROM mnwv2.monitorevents WHERE area_id='$area' and  year='$year' and quarterly='$quarterly')"));
        //     foreach ($brnch as $r) 
        //     {
        //       $branchs[] = $r->branchcode;
        //     } 
        //     $sectionsdata = DB::select(DB::raw("SELECT CONCAT(section,'.', sub_id) AS si,string_agg
        //             (DISTINCT CONCAT( branchcode, ':', point), ',')  as  brands, section, sub_id, question_point as fullmark FROM mnwv2.cal_section_point WHERE event_id IN(SELECT id FROM mnwv2.monitorevents WHERE area_id='$area' and  year='$year' and quarterly='$quarterly') GROUP BY section,sub_id,question_point,branchcode,si"));
        //     foreach ($sectionsdata as $rw) 
        //     {
        //       $data[$rw->si]['fullmark'] = $rw->fullmark;
        //       $data[$rw->si]['section'] = $rw->section;
        //       $tmp = explode(",", $rw->brands);
        //       //var_dump($tmp);

        //       foreach ($tmp as $key => $value) 
        //       {
        //         $tmp2 = explode(":", $value);
        //         $tmp0 = $tmp2[0];
        //         $tmp1 = $tmp2[1];
        //         $data[$rw->si]['branchs'][$tmp0] = $tmp1;
        //       }
        //       /*$data[$values['si']]['fullmark'] = $values['fullmark'];
        //       $data[$values['si']]['section'] = $values['section'];     
        //       $tmp = explode(",", $values['brands']);
        //       foreach ($tmp as $key => $value) {
        //           $tmp2 = explode(":", $value);
        //           $data[$values['si']]['branchs'][$tmp2[0]] = $tmp2[1];
        //       }*/
        //     }
        //    dd($data);
}
}
