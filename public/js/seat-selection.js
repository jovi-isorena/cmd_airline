const seats = document.querySelectorAll(".seat");
const deptPassengers = document.getElementsByName("deptPassenger");
const retPassengers = document.getElementsByName("retPassenger");
const flightTabs = document.getElementsByClassName("flightTab");
let activePassenger;

for(const tab of flightTabs){
    tab.onclick= ()=>{
        console.log(tab.parentElement.parentElement);
        if(!tab.classList.contains("active")){
            for(const siblingTab of flightTabs){
                if(siblingTab != tab){
                    siblingTab.classList.remove("active");
                }
            }
            tab.classList.add("active");
            let pane = document.getElementById(tab.getAttribute("data-toggle"));
            for(const siblingPane of pane.parentElement.children){
                if(siblingPane != pane){
                    siblingPane.classList.add("d-none");
                }
            }
            pane.classList.remove("d-none");
        }
    }
}

for(const seat of seats){
    seat.onclick = ()=>{
        
        if(activePassenger && !seat.classList.contains("selectedSeat") && activePassenger.getAttribute("name") === seat.getAttribute("data-source-for")){
            //kapag iba yung value sa seat, hanapin yung seat tapos remove selected
            let prevSelSeat = activePassenger.parentElement.nextElementSibling.children[0].value;
            if(prevSelSeat){
                seat.parentElement.parentElement.querySelector(`[data-value="${prevSelSeat}"]`).classList.remove("selectedSeat");
                // document.getElementsByName(seat.getAttribute("data-source-for"));
            }
            activePassenger.parentElement.nextElementSibling.children[0].value = seat.getAttribute("data-value");
            activePassenger.parentElement.nextElementSibling.children[1].children[0].innerText = seat.getAttribute("data-value");
            activePassenger.parentElement.nextElementSibling.children[1].children[0].classList.remove("badge-danger");
            activePassenger.parentElement.nextElementSibling.children[1].children[0].classList.add("badge-success");
            seat.classList.add("selectedSeat");
        }
            document.getElementsByName("continue")[0].classList.toggle("d-none",!isAllSeated());
        
    }
}
for(const passenger of deptPassengers){
    passenger.onchange = ()=>{
        console.log(passenger);
        activePassenger = passenger;
        document.getElementById("activeDeptPassenger").innerText = activePassenger.nextElementSibling.innerText;
    }
}
for(const passenger of retPassengers){
    passenger.onchange = ()=>{
        console.log(passenger);
        activePassenger = passenger;
        document.getElementById("activeRetPassenger").innerText = activePassenger.nextElementSibling.innerText;
    }
}

isAllSeated = ()=>{
    const passengers = document.querySelectorAll(".seatHidden");
    for(const passenger of passengers){
        if(passenger.value == null)
            return false;
    }
    return true;

};