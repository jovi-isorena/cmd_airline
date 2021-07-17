<?php



// $path = (getenv('MPDF_ROOT')) ? getenv('MPDF_ROOT') : __DIR__;
// require_once $path . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf([
	'margin_left' => 5,
	'margin_right' => 5,
	'margin_top' => 5,
	'margin_bottom' => 5,
	'margin_header' => 5,
	'margin_footer' => 5
]);

$mpdf->SetProtection(array('print'));
$mpdf->SetTitle("CMD Airline Ticket");
$mpdf->SetAuthor("CMD Airline");
$mpdf->SetDisplayMode('fullpage');
foreach($data['passengers'] as $passenger){
    $ticket = newTicket($data, $passenger);
    $mpdf->WriteHTML($ticket);
    $mpdf->AddPage();

}

$mpdf->Output();

function newTicket($data, $passenger){
    $ticket = '';
    $departure = new DateTime($data['reservedFlight']->flight_date . $data['flightDetail']->departure_time);
    $newId = "0000" . $data['reservedFlight']->reservation_id;
    $newId = "CMD".substr($newId, strlen($newId) - 5, 5);
    $dob = new DateTime($passenger->birthdate);
    $diff = $departure->diff($dob);
    $monthDiff = intval(($diff->format('%y') * 12) + $diff->format('%m'));
    $passengerType = '';
    $bookingNo = $newId;
    if($monthDiff < 24){
        $passengerType = 'Infant';
    }else if($monthDiff < 144){
        $passengerType = 'Children';
    }else if($monthDiff < 720){
        $passengerType = 'Adult';
    }else{
        $passengerType = 'Senior Citizen';
    }


    
    $ticket = '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ticket</title>
        <style>
            *, div, span{
                padding: 0;
                margin: 0;
                box-sizing: border-box;
            }
            body{
                padding: 10px;
                /* justify-content: center;
                display: flex;
                flex-direction: column; */
            }
            .ticket{
                border: 2px solid gray ;
                justify-self: center;
                /* border-radius: 20px; */ 
                width: 800px;
                height: 350px;
                padding: 0;
                overflow-x: hidden;
                overflow-y: hidden;
                /* margin-bottom: 10px; */
                margin: 10px auto;
                position: relative;
                background-image: url("./img/cmdairlines-faded3.png");
            }
            .header{
                background-color: #001e60;
                font-weight: bold;
                color: white;
                /* border: 2px solid black; */
                height: 50px;
                /* line-height: 50px;; */
                padding-left: 10px;
                /* padding-top: 10px; */
            }
            .brandlogo{
                height: 40px;
            }
            .v-align-center{
                vertical-align: text-top;
                height: 100%;
            }
            
            .pt-1{
                padding-top: 15px;
            }
            .pt-3{
                padding-top: 45px;
            }
            .pl-1{
                padding-left: 15px;
            }
            .pl-3{
                padding-left: 45px;
            }
            .pr-3{
                padding-right: 45px;
            }
            .py-3{
                padding-top: 45px;
                padding-bottom: 45px;
            }
            .w-100{
                width: 100%;
            }
            .w-70{
                width: 70%;
            }
            .w-50{
                width: 50%;
            }
            .w-30{
                width: 30%;
            }
            .w-25{
                width: 25%;
            }
            .left-border-dotted{
                border-left: 3px dotted gray;
            }
            .body{
                height: 100%;
                width: 100%;
                position: relative;
                /* border: solid red 3px; */
            }
            .qr{
                width:100px;
                height:100px;
                /* position: absolute;
                bottom: 50px;
                right: 10px; */
            }
            .qr2{
                width: 150px;
                height:150px;
                /* position: absolute;
                bottom: 0px;
                left: 5px; */
                /* display: inline; */
            }
            .muted-text{
                color: gray;
                font-size: .9rem;
                font-style: italic;
            }
            .highlight-text{
                font-weight: bold;
                font-size: 1rem;
                color:black;
            }
            .highlight-text2{
                font-weight: bold;
                font-size: 1.3rem;
                color:black;
            }
            .justify-stretch{
                justify-content: stretch;
            }
            .text-center{
                text-align: center;
            }
            .text-right{
                text-align: right;
            }
            .text-left{
                text-align: left;
            }
            table{
                width:100%;
                height: 100%;
                border: red solid 1px;
                border-collapse: collapse;
                border-radius: 20px;
            }
            td{
                width: 40px;
                border: blue dotted 1px;
                padding-top: 0;
                text-align: center;
            }
            th{
                border: green dotted 1px;
                
            }
            tr{
                min-height: 21px;
            }
            thead{
                border-top-left-radius: 20px;
                border-top-right-radius: 20px;
            }
            
        </style>
    </head>
    <body>
        <div class="ticket" >
            <table>
                <thead>
                    <tr >
                        <th colspan="1" class="header text-left "> <img src="./img/cmdairlineswhite.png" alt="brandlogo" class="brandlogo"> </th>
                        <th colspan="13" class="header text-left"> <span class="v-align-center">CMD Airline</span></th>
                        <th colspan="6" class="header text-left left-border-dotted">'.strtoupper($data['reservedFlight']->fare).'</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- blank row -->
                    <tr>
                        <td><span style="visibility:hidden">dd</span></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        
                        <td class="left-border-dotted"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <!-- fieldname -->
                    <tr>
                        <td></td>
                        <td colspan="4"><span class="muted-text">Passenger Name</span></td>
                        <!-- <td></td>
                        <td></td> -->
                        <!-- <td></td> -->
                        <td></td>
                        <td colspan="2"><span class="muted-text">Gate</span></td>
                        <!-- <td></td> -->
                        <td></td>
                        <td colspan="3"><span class="muted-text">Boarding Time</span></td>
                        <!-- <td></td>
                        <td></td> -->
                        <td></td>
                        <td></td>
                        
                        <td class="left-border-dotted pl-1" colspan="3">'.$departure->format("M d Y").'</td>
                        <!-- <td></td>
                        <td></td> -->
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <!-- data -->
                    <tr>
                        <td></td>
                        <td colspan="4" rowspan="2"><span class="highlight-text2">'.$passenger->firstname . ' ' . $passenger->lastname.'</span></td>
                        <!-- <td></td>
                        <td></td> -->
                        <!-- <td></td> -->
                        <td></td>
                        <td colspan="2"><span class="highlight-text">'. $data['flightDetail']->gate.'</span></td>
                        <!-- <td></td> -->
                        <td></td>
                        <td colspan="3"><span class="highlight-text">'.$departure->format("g:i A").'</span></td>
                        <!-- <td></td>
                        <td></td> -->
                        <td></td>
                        <td></td>
                        
                        <td class="left-border-dotted" colspan="4" rowspan="2"><span class="highlight-text2">'.$passenger->firstname . ' ' . $passenger->lastname.'</span></td>
                        <!-- <td></td>
                        <td></td> -->
                        <!-- <td></td> -->
                        <td></td>
                        <td></td>
                    </tr>
                    <!-- blank -->
                    <tr>
                        <!-- <td></td>
                        <td></td>
                        <td></td> -->
                        <!-- <td></td>
                        <td></td>
                        <td></td> -->
                        <!-- <td></td>
                        <td></td> -->
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <!-- blank -->
                    <tr>
                        <td><span style="visibility:hidden">dd</span></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        
                        <td class="left-border-dotted"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <!-- data -->
                    <tr>
                        <td></td>
                        <td colspan="3"><span class="muted-text">Booking Number</span></td>
                        <!-- <td></td>
                        <td></td> -->
                        <td></td>
                        <td></td>
                        <td colspan="2"><span class="muted-text">Origin</span></td>
                        <!-- <td></td> -->
                        <td></td>
                        <td colspan="3"><span class="muted-text">Destination</span></td>
                        <!-- <td></td>
                        <td></td> -->
                        <!-- <td></td> -->
                        <td></td>
                        <td></td>
    
                        <td class="left-border-dotted" colspan="2"><span class="muted-text">From</span></td>
                        <!-- <td></td> -->
                        <td></td>
                        <td colspan="2"><span class="muted-text">To</span></td>
                        <!-- <td></td> -->
                        <td></td>
                    </tr>
                    <!-- data -->
                    <tr>
                        <td></td>
                        <td colspan="3"><span class="highlight-text">'.$bookingNo.'</span></td>
                        <!-- <td></td>
                        <td></td> -->
                        <td></td>
                        <td></td>
                        <td colspan="2"><span class="highlight-text">'.$data['flightDetail']->airport_origin.'</span></td>
                        <!-- <td></td> -->
                        <td></td>
                        <td colspan="3"><span class="highlight-text">'.$data['flightDetail']->airport_destination.'</span></td>
                        <!-- <td></td>
                        <td></td> -->
                        <td></td>
                        <td></td>
                        <td class="left-border-dotted" colspan="2"><span class="highlight-text">MNL</span></td>
                        <!-- <td></td> -->
                        <td></td>
                        <td colspan="2"><span class="highlight-text">LAX</span></td>
                        <!-- <td></td> -->
                        <td></td>
                    </tr>
                    <!-- blank -->
                    <tr>
                        <td><span style="visibility:hidden">dd</span></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        
                        <td class="left-border-dotted"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <!-- data -->
                    <tr>
                        <td></td>
                        <td colspan="3" rowspan="4"><img src="./img/qr_code.jpg" alt="qr_code" class="qr2"></td>
                        <!-- <td></td>
                        <td></td> -->
                        <!-- <td></td> -->
                        <td colspan="3"><span class="muted-text">Flight No</span></td>
                        <!-- <td></td> -->
                        <!-- <td></td> -->
                        <td colspan="3"><span class="muted-text">Departure Date</span></td>
                        <!-- <td></td> -->
                        <!-- <td></td> -->
                        <td colspan="3"><span class="muted-text">Departure Time</span></td>
                        <td></td>
                        <!-- <td></td> -->
    
                        <td class="left-border-dotted" colspan="2"><span class="muted-text">Seat</span></td>
                        <!-- <td></td> -->
                        <td></td>
                        <td colspan="2"><span class="muted-text">Passenger Type</span></td>
                        <! -- <td></td> -->
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <!-- <td></td>
                        <td></td>
                        <td></td> -->
                        <!-- <td></td> -->
                        <td colspan="3"><span class="highlight-text">'.$data['flightDetail']->flight_no.'</span></td>
                        <!-- <td></td> -->
                        <!-- <td></td> -->
                        <td colspan="3"><span class="highlight-text">'.$departure->format("M d Y").'</span></td>
                        <!-- <td></td> -->
                        <!-- <td></td> -->
                        <td colspan="3"><span class="highlight-text">'.$departure->format("g:i A").'</span></td>
                        <!-- <td></td> -->
                        <td></td>
    
                        <td class="left-border-dotted" colspan="2"><span class="highlight-text">'.$passenger->seat[0]->seat_number.'</span></td>
                        <!-- <td></td> -->
                        <td></td>
                        <td colspan="2"><span class="highlight-text">'.$passengerType.'</span></td>
                        <!-- <td></td> -->
                        <td></td>
                    </tr>
                    <!-- data -->
                    <tr>
                        <td></td>
                        <!-- <td></td>
                        <td></td>
                        <td></td> -->
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="left-border-dotted" colspan="2"><span class="">'.strtoupper($data['reservationDetail']->cabin_class).'</span></td>
                        <!-- <td></td> -->
                        <td></td>
                        <td colspan="2" rowspan="2"><img src="./img/qr_code.jpg" alt="qrcode" class="qr"></td>
                        <!-- <td></td> -->
                        <td></td>
                    </tr>
                    <tr>
                        <!-- <td></td>
                        <td></td>
                        <td></td> -->
                        <!-- <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td> -->
                        <td></td>
                        <!-- <td></td> -->
                        <td colspan="10"> <span  style="text-decoration:underline">Reminder: Present this ticket with your valid ID.</span></td>
                        <td class="left-border-dotted"></td>
                        <!-- <td></td> -->
                        <!-- <td></td> -->
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <!-- <td></td> -->
                        <td colspan="10"><span style="color:#001e60; font-weight: bold;">Enjoy your trip!</span></td>
                        <!-- <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td> -->
                        <td></td>
                        <td class="left-border-dotted" ></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><span style="visibility:hidden">dd</span></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="left-border-dotted"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="left-border-dotted"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    
                </tbody>
            </table>
            
        </div>
        
    </body>
    </html> 
    ';
    return $ticket;
}