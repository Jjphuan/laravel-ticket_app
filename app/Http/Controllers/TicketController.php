<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function allTicket(Request $request ){

        $result = [];
        $ticketList = [];

        $data = Ticket::where('is_full',0)
                ->get();
                
        if($data){
            foreach ($data as $ticket) {

                $ticketList[] = [
                    'id' => $ticket->id,
                    'created_at' => $ticket->created_at->format('Y-m-d H:i:s'),
                    'time' => [
                                'departure' => $ticket->departure_time , 
                                'arrived_time' => $ticket->arrived_time
                            ], 
                    'journey' => [
                                'from' => $ticket->departure , 
                                'to' => $ticket->destination
                            ], 
                    'bus' => $ticket->bus_brand,
                ];
            }

            $result['success'] = true;
            $result['data'] = $ticketList;
        }else{
            $result['success'] = false;
            $result['message'] = "No data Found";
        }

        return response()->json($result,200,[],JSON_UNESCAPED_UNICODE);
    }

    public function getBus(){

        $result = [];
        $busList = [];

        $data = Bus::all();
        if($data){
            foreach ($data as $value) {
                $busList[] = $value->name;
            }
            $result['success'] = true;
            $result['data'] = $busList;
        }else{
            $result['success'] = false;
            $result['message'] = "No data Found";
        }

        return response()->json($result,200,[],JSON_UNESCAPED_UNICODE);
    }

    public function getTicket(Request $request){

        $result = [];

        $data = Ticket::where('id',$request->id)->first();
        if($data){
            $result['success'] = true;
            $result['data'] = $data;
        }else{
            $result['success'] = false;
            $result['message'] = "No data Found";
        }

        return response()->json($result,200,[],JSON_UNESCAPED_UNICODE);
    }

    public function addTicket(Request $request){

        $result = [];

        if($request){
            $departure_time = Carbon::parse($request->departure_time)
                        ->setTimezone('Asia/Kuala_Lumpur')
                        ->toDateTimeString();

            $arrived_time = Carbon::parse($request->arrived_time)
                        ->setTimezone('Asia/Kuala_Lumpur')
                        ->toDateTimeString();

            $data = Ticket::insert(
                [
                    'departure_time'=>$departure_time,
                    'arrived_time'=>$arrived_time,
                    'departure'=>$request->departure_from,
                    'destination'=>$request->arrived_at,
                    'bus_brand'=>$request->bus,
                ]
            );

            if($data){
                $result['success'] = true;
                $result['data'] = $data;
            }else{
                $result['success'] = false;
                $result['data'] = [];
            }
        }

        return response()->json($result,200,[],JSON_UNESCAPED_UNICODE);
    }

    public function editTicket(Request $request){

        $result = [];

        if($request->id){
            $departure_time = Carbon::parse($request->departure_time)
                        ->setTimezone('Asia/Kuala_Lumpur')
                        ->toDateTimeString();

            $arrived_time = Carbon::parse($request->arrived_time)
                        ->setTimezone('Asia/Kuala_Lumpur')
                        ->toDateTimeString();

            $data = Ticket::where('id',$request->id)
                        ->update([
                            'departure_time'=>$departure_time,
                            'arrived_time'=>$arrived_time,
                            'departure'=>$request->departure_from,
                            'destination'=>$request->arrived_at,
                            'bus_brand'=>$request->bus,
                        ]);

            if($data){
                $result['success'] = true;
                $result['data'] = $data;
            }else{
                $result['success'] = false;
                $result['data'] = [];
            }
        }

        return response()->json($result,200,[],JSON_UNESCAPED_UNICODE);
    }

    public function searchTicket(Request $request){

        $result = [];

        $data = Ticket::where('departure_time','LIKE', $request->departureDate. '%')
                    ->where('departure', $request->from)
                    ->where('destination', $request->destination)
                    ->get();


        if($data){
            $result['success'] = true;
            $result['data'] = $data;
        }else{
            $result['success'] = false;
            $result['message'] = "No data Found";
        }

        return response()->json($data,200,[],JSON_UNESCAPED_UNICODE);
    }
}
