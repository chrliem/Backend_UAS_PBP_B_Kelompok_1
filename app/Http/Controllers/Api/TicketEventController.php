<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\TicketEvent;

class TicketEventController extends Controller
{
    public function index()
    {
        $ticketEvent = TicketEvent::all();

        if(count($ticketEvent) > 0)
        {
            return response([
                'message' => 'Seluruh Tiket Event Berhasil Ditampilkan',
                'data' => $ticketEvent
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function show($id)
    {
        $ticketEvent = TicketEvent::find($id);
        
        if(!is_null($ticketEvent))
        {
            return response([
                'message' => 'Tiket Event Berhasil Ditampilkan',
                'data' => $ticketEvent
            ], 200);
        }

        return response([
            'message' => 'Tiket Event Tidak Ditemukan',
            'data' => null
        ], 404);
    }

    public function store(Request $request)
    {
        $storeData = $request->all();

        $validate = Validator::make($storeData, [
            'namaEvent'=> 'required',
            'namaPemesan' => 'required',
            'section' => 'required',
            'seatNumber' => 'required|numeric',
            'tanggalEvent' => 'required',
            'waktuEvent' => 'required',
            'venueEvent' => 'required',
            'alamatEvent' => 'required',
            'harga' => 'required|numeric'
        ]);

        if($validate->fails()) return response(['message' => $validate->errors()], 400);
        
        $ticketEvent = TicketEvent::create($storeData);
        return response([
            'message' => 'Tiket Event Berhasil Ditambahkan',
            'data' => $ticketEvent
        ], 200);
    }

    public function destroy($id)
    {
        $ticketEvent = TicketEvent::find($id);
        
        if(is_null($ticketEvent))
        {
            return response([
                'message' => 'Tiket Event Tidak Ditemukan',
                'data' => null
            ], 404);
        }

        if($ticketEvent->delete())
        {
            return response([
                'message' => 'Tiket Event Berhasil Dihapus',
                'data' => $ticketEvent
            ], 200);
        }
        
        return response([
            'message' => 'Tiket Event Gagal Dihapus',
            'data' => null
        ], 400);
    }

    public function update(Request $request, $id)
    {
        $ticketEvent = TicketEvent::find($id);
        
        if(is_null($ticketEvent))
        {
            return response([
                'message' => 'Tiket Event Tidak Ditemukan',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        
        $validate = Validator::make($updateData, [
            'namaEvent'=> 'required',
            'namaPemesan' => 'required',
            'section' => 'required',
            'seatNumber' => 'required|numeric',
            'tanggalEvent' => 'required',
            'waktuEvent' => 'required',
            'venueEvent' => 'required',
            'alamatEvent' => 'required',
            'harga' => 'required|numeric'
        ]);

        if($validate->fails()) return response(['message' => $validate->errors()], 400);
        
        $ticketEvent->namaEvent = $updateData['namaEvent'];
        $ticketEvent->namaPemesan = $updateData['namaPemesan'];
        $ticketEvent->section = $updateData['section'];
        $ticketEvent->seatNumber = $updateData['seatNumber'];
        $ticketEvent->tanggalEvent = $updateData['tanggalEvent'];
        $ticketEvent->waktuEvent = $updateData['waktuEvent'];
        $ticketEvent->venueEvent = $updateData['venueEvent'];
        $ticketEvent->alamatEvent = $updateData['alamatEvent'];
        $ticketEvent->harga = $updateData['harga'];
        
        if($ticketEvent->save())
        {
            return response([
                'message' => 'Tiket Event Berhasil Diubah',
                'data' => $ticketEvent
            ], 200);
        }
        
        return response([
            'message' => 'Tiket Event Gagal Diubah',
            'data' => null
        ], 400);
        
    }
}
