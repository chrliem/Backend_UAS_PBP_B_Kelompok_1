<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\TicketMovie;

class TicketMovieController extends Controller
{
    public function index()
    {
        $ticketMovie = TicketMovie::all();

        if(count($ticketMovie) > 0)
        {
            return response([
                'message' => 'Seluruh Tiket Movie Berhasil Ditampilkan',
                'data' => $ticketMovie
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function show($id)
    {
        $ticketMovie = TicketMovie::find($id);
        
        if(!is_null($ticketMovie))
        {
            return response([
                'message' => 'Tiket Movie Berhasil Ditampilkan',
                'data' => [$ticketMovie]
            ], 200);
        }

        return response([
            'message' => 'Tiket Movie Tidak Ditemukan',
            'data' => null
        ], 404);
    }

    public function store(Request $request)
    {
        $storeData = $request->all();

        $validate = Validator::make($storeData, [
            'namaMovie'=> 'required',
            'namaPemesan' => 'required',
            'seatNumber' => 'required|numeric',
            'tanggalMovie' => 'required',
            'waktuMovie' => 'required',
            'sinopsis' => 'required',
            'harga' => 'required|numeric'
        ]);

        if($validate->fails()) return response(['message' => $validate->errors()], 400);
        
        $ticketMovie = TicketMovie::create($storeData);
        return response([
            'message' => 'Tiket Movie Berhasil Ditambahkan',
            'data' => [$ticketMovie]
        ], 200);
    }

    public function destroy($id)
    {
        $ticketMovie = TicketMovie::find($id);
        
        if(is_null($ticketMovie))
        {
            return response([
                'message' => 'Tiket Movie Tidak Ditemukan',
                'data' => null
            ], 404);
        }

        if($ticketMovie->delete())
        {
            return response([
                'message' => 'Tiket Movie Berhasil Dihapus',
                'data' => [$ticketMovie]
            ], 200);
        }
        
        return response([
            'message' => 'Tiket Movie Gagal Dihapus',
            'data' => null
        ], 400);
    }

    public function update(Request $request, $id)
    {
        $ticketMovie = TicketMovie::find($id);
        
        if(is_null($ticketMovie))
        {
            return response([
                'message' => 'Tiket Movie Tidak Ditemukan',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        
        $validate = Validator::make($updateData, [
            'seatNumber' => 'required|numeric',
            'waktuMovie' => 'required',
        ]);

        if($validate->fails()) return response(['message' => $validate->errors()], 400);
        
        $ticketMovie->seatNumber = $updateData['seatNumber'];
        $ticketMovie->waktuMovie = $updateData['waktuMovie'];
        
        if($ticketMovie->save())
        {
            return response([
                'message' => 'Tiket Movie Berhasil Diubah',
                'data' => [$ticketMovie]
            ], 200);
        }
        
        return response([
            'message' => 'Tiket Movie Gagal Diubah',
            'data' => null
        ], 400);
    }
}
