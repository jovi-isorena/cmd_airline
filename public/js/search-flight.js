const oneWay = document.getElementById("oneWay");
const roundTrip = document.getElementById("roundTrip");
const returnDate = document.getElementById("returnGroup");
oneWay.onchange = ()=>{
    returnDate.classList.toggle("d-none", true);
    returnDate.classList.toggle("d-block", false);
};
roundTrip.onchange = ()=>{
    returnDate.classList.toggle("d-none", false);
    returnDate.classList.toggle("d-block", true);
};

window.onload = ()=>{
    if(roundTrip.checked){
        returnDate.classList.toggle("d-block", true);
        returnDate.classList.toggle("d-none", false);

    }
    else if(oneWay.checked){
        returnDate.classList.toggle("d-block", false);
        returnDate.classList.toggle("d-none", true);

    }
};