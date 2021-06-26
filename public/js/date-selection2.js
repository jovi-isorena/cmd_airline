
// const deptDates = document.getElementsByName("selectedDeptDate");
const deptDates = document.getElementsByName("deptDate");
const retDates = document.getElementsByName("retDate");
const myForm = document.getElementById("myForm");
const deptFares = document.getElementsByName("deptFareMatrix");
const retFares = document.getElementsByName("retFareMatrix");


//for changing departure date
for (const dept of deptDates){
    dept.onclick = (e)=>{
        e.preventDefault;
        document.getElementById("selectedDeptDate").value = dept.value;
        document.getElementById("selectedDeptFlight").value = '';
        document.getElementById("selectedDeptFare").value = '';
    }
}
//for changing return date
for (const ret of retDates){
    ret.onclick = (e)=>{
        e.preventDefault;
        document.getElementById("selectedRetDate").value = ret.value;
        document.getElementById("selectedRetFlight").value = '';
        document.getElementById("selectedRetFare").value = '';
    }
}
console.log(deptFares);


for (const dept of deptFares){
    dept.onchange = ()=>{
        for (const otherFare of deptFares){
            if(dept != otherFare)
                otherFare.parentElement.classList.remove("selectedFareBox");
                otherFare.parentElement.classList.add("fareBox");
        }
        dept.parentElement.classList.toggle("selectedFareBox", dept.checked);
        document.getElementById("selectedDeptFlight").value = dept.getAttribute("data-flight");
        document.getElementById("selectedDeptFare").value = dept.getAttribute("data-fare");
    };
    dept.onload = ()=>{
        
    };
}
for (const ret of retFares){
    ret.onchange = ()=>{
        for (const otherFare of retFares){
            if(ret != otherFare)
                otherFare.parentElement.classList.remove("selectedFareBox");
                otherFare.parentElement.classList.add("fareBox");
        }
        ret.parentElement.classList.toggle("selectedFareBox", ret.checked);
        document.getElementById("selectedRetFlight").value = ret.getAttribute("data-flight");
        document.getElementById("selectedRetFare").value = ret.getAttribute("data-fare");
    };
}
