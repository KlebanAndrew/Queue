<?php

namespace App\Http\Controllers;

use App\Queue;
use Illuminate\Http\Request;
use Response;
//use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Current_setting;
use Carbon\Carbon;

class IndexController extends Controller
{
    /**
     * Головна клієнтська сторінка
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $today = Carbon::now()->format('Y-m-d');
        $queueModel = new Queue();
        $queue = $queueModel->where('date', '=', $today)->get();
        $cur_settings = Current_setting::where('day_date', '=', $today)->get();
        $cur_settings->sortBy('period_start_time');
        $result = array();
        foreach ($cur_settings as $c){
            $check = Queue::where('start_time', '=', $c['period_start_time'])
              ->where('date', '=',$c['day_date'] )->get();
            if($check->count() < 4){
            array_push($result,1);}
            else{
                array_push($result, 0);
            }
        }
        //dd($result);

        return view('index.index', ['queue' => $queue, 'cur_settings' => $cur_settings, 'check_array' => $result]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

    }

    /**
     * запис запису черги періоду в БД
     * @param Queue $queueModel
     * @param Current_setting $cur_setting
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Queue $queueModel, Current_setting $cur_setting, Request $request)
    {
        $cur_date = Carbon::today()->toDateString();
        $cur_date = str_replace('-', '', $cur_date);
        $checked = false;
        while(!$checked){
            $rand = rand(1000,9999);
            $check_date = $cur_date.$rand;
            if($queueModel->where('register_key', '=', $check_date)->get()->count() == 0){
                $cur_date .= $rand;
                $checked = true;
            }else{
                $checked = false;
            }

        }
        $data = $request->all();
        unset($data['_token']);
        $data['register_key'] = $cur_date;
        $queueModel->create($data);
        $data['register_key'] = substr($cur_date, -4);
        return Response::json($data);
    }

    /**
     * отримання списку періодів і стану черги на день
     * @param Queue $queueModel
     * @param Current_setting $cur_setting
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDay(Queue $queueModel, Current_setting $cur_setting, Request $request)
    {
        //todo Зробити функціонал для оновлення інформації про чергу відносно дня.
        $queueModel = new Queue();
        $today = $request->input('date');
        $res['cur_settings'] = Current_setting::where('day_date', '=', $today)->get();
        $res['res_array'] = array();
        foreach ($res['cur_settings'] as $c){
            $check = Queue::where('start_time', '=', $c['period_start_time'])
                ->where('date', '=',$c['day_date'] )->get();

            if($check->count() < 4){
                array_push($res['res_array'],1);}
            else{
                array_push($res['res_array'], 0);
            }
        }
        return Response::json($res);

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

    /**********************************AJAX section********************************************************/

}
