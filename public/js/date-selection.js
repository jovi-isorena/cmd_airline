// let dateResults = document.getElementsByClassName("dateResult");
let dateResults = document.getElementsByName("selectedDeptDate");
console.log(dateResults);

for (const date of dateResults){
    date.onchange = ()=>{
        for (const otherDate of dateResults){
            if(date != otherDate)
                otherDate.parentElement.classList.remove("selectedDate");
        }
        date.parentElement.classList.toggle("selectedDate", date.checked);

    };
    // date.addEventListener("")
}
