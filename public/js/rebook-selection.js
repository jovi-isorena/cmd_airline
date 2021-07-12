
// const deptDates = document.getElementsByName("selectedDeptDate");
const deptDates = document.getElementsByName("deptDate");
const myForm = document.getElementById("myForm");
const deptFares = document.getElementsByName("deptFareMatrix");


//for changing departure date
for (const dept of deptDates){
    dept.onclick = (e)=>{
        e.preventDefault;
        document.getElementById("selectedDate").value = dept.value;
        document.getElementById("selectedFlight").value = '';
        document.getElementById("selectedFare").value = '';
        
    }
}



for (const dept of deptFares){
    dept.onchange = ()=>{
        for (const otherFare of deptFares){
            if(dept != otherFare)
                otherFare.parentElement.classList.remove("selectedFareBox");
                otherFare.parentElement.classList.add("fareBox");
                otherFare.parentElement.parentElement.parentElement.classList.remove("selectedFlightDetail");
        }
        dept.parentElement.classList.toggle("selectedFareBox", dept.checked);
        dept.parentElement.parentElement.parentElement.classList.toggle("selectedFlightDetail",true);
        
        document.getElementById("selectedFlight").value = dept.getAttribute("data-flight");
        document.getElementById("selectedFare").value = dept.getAttribute("data-fare");
        //enable or disable continue button
        if((document.getElementById("selectedFlight").value == document.getElementById("currentFlight").value) &&
        (document.getElementById("selectedFare").value == document.getElementById("currentFare").value) &&
        (document.getElementById("selectedDate").value == document.getElementById("currentDate").value)){
            document.getElementById("btnContinue").classList.add("d-none");
        }else{
            document.getElementById("btnContinue").classList.remove("d-none");
        }

    };
}

