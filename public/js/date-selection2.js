
const deptResults = document.getElementsByName("selectedDeptDate");
const retResults = document.getElementsByName("selectedRtDate");
const myForm = document.getElementById("myForm");

for (const dept of deptResults){
    dept.onclick = (e)=>{
        e.preventDefault;
        document.getElementById("selectedDeptDate").value = dept.value;
        myForm.submit();
    }
}
for (const ret of retResults){
    ret.onclick = (e)=>{
        e.preventDefault;
        document.getElementById("selectedRetDate").value = ret.value;
        myForm.submit();
    }
}
