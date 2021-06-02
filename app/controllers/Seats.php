<?php

class Seats extends Controller{
    public function __construct(){
        $this->seatModel = $this->model('Seat');
        $this->flightModel = $this->model('Flight');
    }

    public function manage($flightNo){
        $flight = $this->flightModel->getFlightByNumber($flightNo);
        $data = [
            'title' => 'Manage Seats'

        ];

        $this->view('seats/manage', $data);
    }

    public function create(){
        
    }
}