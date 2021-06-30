let edits = document.querySelectorAll(".edit-info");
let saves = document.querySelectorAll(".save-info");
console.log(edits);
edits.forEach(edit => {
    edit.addEventListener("click",()=>{
        edit.parentElement.nextElementSibling.classList.toggle("d-block", true);
        edit.parentElement.nextElementSibling.classList.toggle("d-none", false);
        edit.classList.toggle("d-none");
        console.log(edit.parentElement.nextElementSibling);   
        document.getElementsByName("continue")[0].classList.add("d-none");

    });
});
saves.forEach(save => {
    save.addEventListener("click",()=>{
        if(validateInfo(save.getAttribute("data-link"))){
            save.parentElement.parentElement.classList.toggle("d-block", false);
            save.parentElement.parentElement.classList.toggle("d-none", true);
            save.parentElement.parentElement.previousElementSibling.children[1].classList.toggle("d-none");

        }else{
            console.log("something went wrong.");   
        }
        if([...edits].reduce((ret, val)=>{ return ret && !(val.classList.contains("d-none"))}, true)){
            console.log("all is good");
            document.getElementsByName("continue")[0].classList.remove("d-none");
        }else{
            console.log("not all good");
            document.getElementsByName("continue")[0].classList.add("d-none");
            
        }
    });
});

function validateInfo(id){
    let isFnValid = isLnValid = isGenValid = isDobValid = isDocTypeValid = isDocNumValid = isCountryValid = isExpiryValid = false;
    fname = document.getElementById("firstname"+id);
    if(fname.value.trim() != ''){
        isFnValid = true;
        fname.previousElementSibling.innerText = '* ';
    }
    else{
        fname.previousElementSibling.innerText = '* Required Field.';
        isFnValid = false;
    } 

    lname = document.getElementById("lastname"+id);
    if(lname.value.trim() != ''){
        isLnValid = true;
        lname.previousElementSibling.innerText = '* ';
    }
    else{
        lname.previousElementSibling.innerText = '* Required Field.';
        isLnValid = false;
    } 

    gender = document.getElementById("gender"+id);
    if(gender.value.trim() != ''){
        isGenValid = true;
        gender.previousElementSibling.innerText = '* ';
    }
    else{
        gender.previousElementSibling.innerText = '* Required Field.';
        isGenValid = false;
    }

    dob = document.getElementById("dob"+id);
    if(dob.value != ''){
        isDobValid = true;
        dob.previousElementSibling.innerText = '* ';
    }
    else{
        dob.previousElementSibling.innerText = '* Required Field.';
        isDobValid = false;
    }

    doctype = document.getElementById("doctype"+id);
    if(doctype.value.trim() != ''){
        isDocTypeValid = true;
        doctype.previousElementSibling.innerText = '* ';
    }
    else{
        doctype.previousElementSibling.innerText = '* Required Field.';
         isDocTypeValid = false;
    }

    docnum = document.getElementById("docnumber"+id);
    if(docnum.value.trim() != ''){
        isDocNumValid = true;
        docnum.previousElementSibling.innerText = '* ';
    }
    else{
        docnum.previousElementSibling.innerText = '* Required Field.';
        isDocNumValid = false;
    }

    country = document.getElementById("issuingcountry"+id);
    if(country.value.trim() != ''){
        isCountryValid = true;
        country.previousElementSibling.innerText = '* ';
    }
    else{
        country.previousElementSibling.innerText = '* Required Field.';
        isCountryValid = false;
    }

    expiry = document.getElementById("expiration"+id);
    if(expiry.value.trim() != ''){
        isExpiryValid = true;
        expiry.previousElementSibling.innerText = '* ';
    }
    else{
        expiry.previousElementSibling.innerText = '* Required Field.';
        isExpiryValid = false;
    }

    if(isFnValid && isLnValid && isGenValid && isDobValid && isDocTypeValid && isDocNumValid && isCountryValid && isExpiryValid){
        return true;
    }else return false;
}