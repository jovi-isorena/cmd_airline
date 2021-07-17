<?php

class Tickets extends Controller{
    public function __construct()
    {
        $this->reservedFlightModel = $this->model('ReservedFlight');
        $this->scheduleModel = $this->model('Schedule');
        $this->passengerModel = $this->model('Passenger');
        $this->reservedSeatModel = $this->model('ReservedSeat');
        $this->reservationModel = $this->model('Reservation');
        $this->flightFareModel = $this->model('FlightFare');
        $this->fareModel = $this->model('Fare');
    }

    public function flightTicket($reservedFlightId){
        $reservedFlight = $this->reservedFlightModel->getFlightById($reservedFlightId);
        $reservedFlight->fare = $this->fareModel->getFareById($this->flightFareModel->getFlightFareById($reservedFlight->fare_id)->fare_id)->name;
        $flightDetail = $this->scheduleModel->getScheduleDetails($reservedFlight->schedule_id);
        $passengers = $this->passengerModel->getAllPassengersByReservationId($reservedFlight->reservation_id,$reservedFlightId);
        $reservationDetail = $this->reservationModel->getReservationById($reservedFlight->reservation_id);
        foreach($passengers as $passenger){
            $passenger->seat = $this->reservedSeatModel->getReservedSeatByPassengerId($passenger->id);
        }
        
        $data = [
            'reservationDetail' => $reservationDetail,
            'reservedFlight' => $reservedFlight,
            'flightDetail' => $flightDetail,
            'passengers' => $passengers
        ];
        $this->view("tickets/flightTicket", $data);
    }
}