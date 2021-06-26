// let dateResults = document.getElementsByClassName("dateResult");
const deptResults = document.getElementsByName("selectedDeptDate");
const retResults = document.getElementsByName("selectedRetDate");
for (const dept of deptResults){
    dept.onchange = ()=>{
        for (const otherDate of deptResults){
            if(dept != otherDate)
                otherDate.parentElement.classList.remove("selectedDate");
        }
        dept.parentElement.classList.toggle("selectedDate", dept.checked);

    };
    // date.addEventListener("")
}


for (const ret of retResults){
    ret.onchange = ()=>{
        for (const otherDate of retResults){
            if(ret != otherDate)
                otherDate.parentElement.classList.remove("selectedDate");
        }
        ret.parentElement.classList.toggle("selectedDate", ret.checked);

    };
}