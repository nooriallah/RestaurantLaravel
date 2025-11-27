<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Table;
use App\Rules\DateBetween;
use App\Rules\TimeBetween;
use Exception;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = Reservation::all();
        return view('admin.reservations.index', compact('reservations'));
    }

    /** 
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tables = Table::where('status', 'available')->get();
        $reservations = Reservation::all();
        return view('admin.reservations.create', compact(['tables', 'reservations']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            $request->validate([
                "full_name" => "required",
                "contact_number" => "required",
                "email" => "nullable|email",
                "special_requests" => "nullable",
                "reservation_time" => ["required", new TimeBetween()],
                "number_of_guests" => "required|integer|min:1",
                "table_id" => "required",
                "user_id" => "required"
            ]);

            if ($request->number_of_guests > Table::findOrFail($request->table_id)->capacity) {
                return redirect()->back()->withInput()->withErrors(['number_of_guests' => 'Number of guests exceeds table capacity.']);
            }

            Reservation::create([
                "full_name" => $request->full_name,
                "contact_number" => $request->contact_number,
                "email" => $request->email,
                "special_requests" => $request->special_requests,
                "reservation_time" => $request->reservation_time,
                "number_of_guests" => $request->number_of_guests,
                "table_id" => $request->table_id,
                "user_id" => $request->user_id
            ]);

            return redirect()->route("reservations.index")->with("success", "Table successfuly reserverd for $request->full_name");
        } catch (Exception $exp) {
            dd("Error: " . $exp);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        $tables = Table::where('status', 'available')->orWhere('id', $reservation->table_id)->get();


        return view('admin.reservations.edit', compact(['tables', "reservation"]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        try {

            $request->validate([
                "full_name" => "required",
                "contact_number" => "required",
                "email" => "nullable|email",
                "special_requests" => "nullable",
                "reservation_time" => ["required", new TimeBetween(), new DateBetween()],
                "number_of_guests" => "required|integer|min:1",
                "user_id" => "required",
                "table_id" => "required",
            ]);
            if ($request->number_of_guests > Table::findOrFail($request->table_id)->capacity) {
                return redirect()->back()->withInput()->withErrors(['number_of_guests' => 'Number of guests exceeds table capacity.']);
            }
            $reservation->update(attributes: [
                "full_name" => $request->full_name,
                "contact_number" => $request->contact_number,
                "email" => $request->email,
                "special_requests" => $request->special_requests,
                "reservation_time" => $request->reservation_time,
                "number_of_guests" => $request->number_of_guests,
                "table_id" => $request->table_id,
                "user_id" => $request->user_id,
            ]);

            return redirect()->route("reservations.index")->with("success", "Reservation updated successfully.");
        } catch (Exception $exp) {
            dd("Error: " . $exp);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        Reservation::destroy(ids: $reservation->id);
        return redirect()->route("reservations.index")->with("success", "Reservation deleted successfully.");
    }
}
