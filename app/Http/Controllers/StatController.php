<?php

namespace App\Http\Controllers;

use App\Default_day;
use App\Default_setting;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Queue;
use Response;
use App\Current_setting;
use Carbon\Carbon;

class StatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = Carbon::now()->format('Y-m-d');
        $queueModel = new Queue();
        $queue = $queueModel->where('date', '=', $today)->get();
        $queue->sortBy('start_time');
        $cur_settings = Current_setting::where('day_date', '=', $today)->get();
        $cur_settings->sortBy('period_start_time');
        $check_count = array();
        $periods = array();
        $counts = array();
        $counts['all'] = $queue->count();
        $counts['real_queue'] = Queue::where('date', '=', $today)->where('is_real_queue', '=', 1)->get()->count();
        $counts['online_queue'] = Queue::where('date', '=', $today)->where('is_real_queue', '=', 0)->get()->count();
        foreach ($cur_settings as $c){

            $check = Queue::where('start_time', '=', $c['period_start_time'])
                ->where('date', '=',$c['day_date'] )->get();
            $period['period_start_time'] =  $c['period_start_time'];
            $period['period_end_time'] =  $c['period_end_time'];
            $period['queue'] =  $check;
            $period['count'] =  $check->count();
            if($check->count() < 4){
                array_push($check_count,1);}
            else{
                array_push($check_count, 0);
            }
            array_push($periods, $period);
        }
        return view('stat.index', ['cur_settings' => $cur_settings, 'queue' => $queue, 'periods' => $periods, 'counts' => $counts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getDay(Request $request)
    {
        $date = $request->input('date');
        $queueModel = new Queue();
        $queue = $queueModel->where('date', '=', $date)->get();
        $counts['all'] = $queue->count();
        $counts['real_queue'] = $queueModel->where('date', '=', $date)->where('is_real_queue', '=', 1)->get()->count();
        $counts['online_queue'] = $queueModel->where('date', '=', $date)->where('is_real_queue', '=', 0)->get()->count();
        $cur_settings = Current_setting::where('day_date', '=', $date)->get();
        $cur_settings->sortBy('period_start_time');
        $periods = array();
        foreach ($cur_settings as $c){

            $check = Queue::where('start_time', '=', $c['period_start_time'])
                ->where('date', '=',$c['day_date'] )->get();
            $period['period_start_time'] =  $c['period_start_time'];
            $period['period_end_time'] =  $c['period_end_time'];
            $period['queue'] =  $check;
            $period['count'] =  $check->count();
            array_push($periods, $period);
        }
        $data['periods'] = $periods;
        $data['counts'] = $counts;
        return Response::json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
