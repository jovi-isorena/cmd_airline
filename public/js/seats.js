let rows = document.getElementById("rows");
let cols = document.getElementById("cols");
let newLayout = document.getElementById("btnNew");
let modLayout = document.getElementById("btnMod");
let copyLayout = document.getElementById("btnCopy");
let cancelNew = document.getElementById("btnCancel");
let generate = document.getElementById("generate");
let reset = document.getElementById("resetgrid");
let gridWrapper = document.getElementById("seatgrid-wrapper");
let radSeat = document.getElementsByName("options");
let seats = [];
let yCoor = [];
let xCoor = [];
let rowCount = 0;
let colCount = 0;
let divXCoor = document.getElementById("xCoor");
let divYCoor = document.getElementById("yCoor");
let mouseIsDown = false;
let aircraftId = document.getElementById("aircraftId").value;
let layouts = document.getElementById("layouts");
let isFullSeats = false;
let selectedClass = "0";
let editMode = false;
let modify = false;

window.addEventListener("load", ()=>{
    console.log("hey");
    radSeat.forEach(rad=>{
        rad.disabled = true;
    })
    modLayout.disabled = true;
    copyLayout.disabled = true;
});

checkSeat = ()=>{
    if(radSeat[0].checked) return radSeat[0].value; 
    if(radSeat[1].checked) return radSeat[1].value; 
    if(radSeat[2].checked) return radSeat[2].value; 
    if(radSeat[3].checked) return radSeat[3].value; 
};

radSeat.forEach(rad => {
    rad.addEventListener("change", (e)=>{
        selectedClass = e.target.value;
    });
});

edit = ()=>{
    const divNewLayout = document.getElementById("newLayout");
    const divExistingLayouts = document.getElementById("existingLayouts");
    divNewLayout.classList.toggle("d-block", true);
    divNewLayout.classList.toggle("d-none", false);
    divExistingLayouts.classList.toggle("d-block", false);
    divExistingLayouts.classList.toggle("d-none", true);
    editMode = true;
    radSeat.forEach(rad=>{
        rad.disabled = false;
        rad.classList.toggle("d-none");
    })
    
}

newLayout.addEventListener("click", ()=>{
    edit();
    resetAll(gridWrapper);
    modify = false;
});
copyLayout.addEventListener("click", ()=>{
    edit();
    modify = false;
    document.getElementById("name").value = '';
    document.getElementById("newLayout").getElementsByTagName("legend")[0].innerText = "Copy Layout";
    
});
modLayout.addEventListener("click", ()=>{
    edit();
    modify = true;
    document.getElementById("newLayout").getElementsByTagName("legend")[0].innerText = "Modify Layout";
    
});

cancelNew.addEventListener("click", ()=>{
    // const divNewLayout = document.getElementById("newLayout");
    // const divExistingLayouts = document.getElementById("existingLayouts");
    // divNewLayout.classList.toggle("d-block", false);
    // divNewLayout.classList.toggle("d-none", true);
    // divExistingLayouts.classList.toggle("d-block", true);
    // divExistingLayouts.classList.toggle("d-none", false);
    location.reload();
})

function resetAll(wrapper){
    // if(wrapper.lastChild)wrapper.removeChild(wrapper.lastChild);
    document.getElementById("name").value = '';
    seats = []
    rows.value = undefined;
    cols.value = undefined;
    xCoor = [];
    yCoor = [];
    rowCount = 0;
    colCount = 0;
    countSeats();
    redraw(wrapper);
}

function redraw(wrapper){
    wrapper.removeChild(wrapper.lastChild);
    wrapper.appendChild(createGrid());
    // toStringArray(toNumberArray(seats));
    //STOPPED HERE ==============================================================================================
}

layouts.addEventListener("change", async (e)=>{
    console.log(e.target.value);
    //fetch layout then generate
   if( e.target.value != 0){
        modLayout.disabled = false;
        modLayout.classList.toggle("disabled", false);
        copyLayout.disabled = false;
        copyLayout.classList.toggle("disabled", false);

        if(window.XMLHttpRequest)
            var ajax = new XMLHttpRequest();
        else
            var ajax = new ActiveXObject("Microsoft.XMLHTTP");

        let method = "GET";
        let url = "/cmd_airline/seatlayouts/getLayoutById/" + e.target.value;
        let asynchronous = true;
        ajax.open(method, url, asynchronous);
        // ajax.setRequestHeader("Content-Type", "application/json");
        ajax.send(); //for post method
        ajax.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                console.log("from ajax: " + (this.responseText));
                let response =JSON.parse(this.responseText);
                // console.log(resp.layout);
                document.getElementById("name").value = response.name;
                seats = JSON.parse(response.layout);

                rows.value = rowCount = seats.length;
                cols.value = colCount = seats[0].length;
                console.table(seats);
                redraw(gridWrapper);
                renameGrid();
            }
        }
    }else{
        resetAll(gridWrapper);
        copyLayout.disabled = true;
        copyLayout.classList.toggle("disabled", true);
        modLayout.disabled = true;
        modLayout.classList.toggle("disabled", true);
    }

});

document.addEventListener("mousedown", (e)=>{
    mouseIsDown = true;
});
document.addEventListener("mouseup", (e)=>{
    mouseIsDown = false;
});

function newElement(elementType, classList = [], innerhtml = '', innertext = ''){
    let elem = document.createElement(elementType);
    if(classList)
        for (let index = 0; index < classList.length; index++) {
            elem.classList.add(classList[index]);
        }    
    if(innerhtml)        
        elem.innerHTML = innerhtml;
    if(innertext)        
        elem.innerText = innertext;
    return elem;
}

//count seats. returns true if full, otherwise returns false 
countSeats = ()=>{
    let eco = document.getElementById("economy_count");
    let pre = document.getElementById("premium_count");
    let bus = document.getElementById("business_count");
    let tot = document.getElementById("capacity");
    let eco_count = 0, pre_count = 0, bus_count = 0, tot_count = 0;
    seats.map((seatRow) => {
        seatRow.map(seat => {
            switch (seat) {
                case "1":
                    eco_count++;
                    tot_count++;
                    break;
                case "2":
                    pre_count++;
                    tot_count++;
                    break;
                case "3":
                    bus_count++;
                    tot_count++;
                    break;
                default:
                    break;
            }
        })
    });
    eco.innerText = eco_count;
    pre.innerText = pre_count;
    bus.innerText = bus_count;
    tot.innerText = tot_count + "/" + tot.innerText.split("/")[1];
    if(tot_count >= tot.innerText.split("/")[1]){
        tot.classList.add("text-danger");
        return true;
    }
        
    else{
        tot.classList.remove("text-danger");
        return false;
    }

    

}
//naming the columns and rows
renameGrid = ()=>{
    renameCol();
    renameRow();
};
//naming columns
renameCol = () => {
    xCoor = [];
    let currentChar = 'A';
    for(let index = 0; index < colCount; index++){
        let hasElement = false;
        for (let index2 = 0; index2 < rowCount; index2++) {
            if(seats[index2][index] != "0"){
                hasElement = true;
                break;
            }
        }
        if(hasElement){
            xCoor[index] = currentChar;
            currentChar = getNextCharacter(currentChar);
        }else{
            xCoor[index] = ' ';
        }
    }
    while(divXCoor.lastElementChild){
        divXCoor.removeChild(divXCoor.lastElementChild);
    }
    let newSpan = document.createElement("SPAN");
    newSpan.classList.add("labelBox");
    divXCoor.appendChild(newSpan);
    for (let index = 0; index < xCoor.length; index++) {
        newSpan = document.createElement("SPAN");
        newSpan.classList.add("labelBox");
        newSpan.innerText = xCoor[index];
        divXCoor.appendChild(newSpan);
    }
};
//naming rows
renameRow = () => {
    yCoor = [];
    let currentChar = 1;
    for(let index = 0; index < rowCount; index++){
        let hasElement = false;
        for (let index2 = 0; index2 < colCount; index2++) {
            if(seats[index][index2] != "0"){
                hasElement = true;
                break;
            }
        }
        if(hasElement){
            yCoor[index] = currentChar;
            currentChar += 1;
        }else{
            yCoor[index] = ' ';
        }
    }
    while(divYCoor.lastElementChild){
        divYCoor.removeChild(divYCoor.lastElementChild);
    }
    for (let index = 0; index < yCoor.length; index++) {
        let newSpan = document.createElement("DIV");
        newSpan.classList.add("labelBox");
        newSpan.innerText = yCoor[index];
        divYCoor.appendChild(newSpan);
    }
}
//essential for naming columns
getNextCharacter = (c)=>{
    return String.fromCharCode(c.charCodeAt(0) + 1);

}
//grid creation
function createGrid() {
    let strClass = ["empty","economy","premium","business"]; 
    // console.log("redraw");
    // console.table(seats);
    let seatGrid = newElement("div",["seatgrid"]);
    
    for (let index = 0; index < seats.length; index++) {
        
        let newRow = newElement("div",["row"]);
        for (let index2 = 0; index2 < seats[index].length; index2++) {
            
            let newCol = newElement("div", ["box", strClass[seats[index][index2]]]);
           
            newCol.addEventListener("mousedown", (e)=>{
                mouseIsDown = true;
                // if(!isFullSeats){
                    // radSeat.forEach(rad => {
                        console.log(selectedClass !=0 && seats[index][index2] != selectedClass && seats[index][index2] != 0);

                        if( editMode && ((!isFullSeats || selectedClass == 0) || (selectedClass !=0 && seats[index][index2] != selectedClass && seats[index][index2] != 0))){
                            if(seats[index][index2] == selectedClass){
                                seats[index][index2] = "0";
                            }else{
                                seats[index][index2] = selectedClass;
                            }
                            
                        }
                    // });
                    redraw(gridWrapper);
                    renameGrid();
                    console.table(seats);
                // }
                
            });
            newCol.addEventListener("mouseup", (e)=>{
                mouseIsDown = false;
            });
            newCol.addEventListener("mouseenter", (e) =>{
                // if(!isFullSeats){
                    if(mouseIsDown){
                        // radSeat.forEach(rad => {
                            console.log(selectedClass !=0 && seats[index][index2] != selectedClass);
                            if(!isFullSeats || selectedClass == 0 || (selectedClass !=0 && seats[index][index2] != selectedClass && seats[index][index2] != 0)){
                                seats[index][index2] = selectedClass;
                            }
                        // });
                        redraw(gridWrapper)
                        renameGrid();
                    }
                // }
            });
            newRow.appendChild(newCol);
        }
        seatGrid.appendChild(newRow);
    }
    renameGrid();
    isFullSeats = countSeats();
    return seatGrid;
}
createRow = () => {

}
addRows = (num) => {

}

generate.addEventListener("click", (e) =>{
    e.preventDefault();
    rowCount = parseInt(rows.value);
    colCount = parseInt(cols.value);
    seats = [];
    xCoor = [];
    yCoor = [];
    if(rowCount <= 0 || colCount <= 0){
        alert("Row and Column cannot be zero.");
    }else{
        for (let i = 0; i < rowCount; i++) {
            seats[i] = [];
            for (let j = 0; j < colCount; j++) {
                seats[i][j] = "0";
            }
        }
        redraw(gridWrapper);
    }
});
reset.addEventListener("click", (e) =>{
    e.preventDefault();
    for (let i = 0; i < rowCount; i++) {
        seats[i] = [];
        for (let j = 0; j < colCount; j++) {
            seats[i][j] = "0";
            
        }
        
    }
    redraw(gridWrapper)
});

//testing area
function toNumberArray(strArray){
    // const doubled = numbers.map(item => item * 2);
    let arr = [];
    

    strArray.map(seatRow => {
        arr[strArray.indexOf(seatRow)] = seatRow.map(seat => {
            switch (seat) {
                case "empty":
                    return 0;
                case "economy":
                    return 1;
                case "premium":
                    return 2;
                case "business":
                    return 3;
            
                default:
                    break;
            }
        });
    });
    console.table(arr);
    return arr;
}



async function testFunction(e){
    e.preventDefault();
    // let jsoon = JSON.stringify(seats);
    let jsoon = JSON.stringify(seats);
    // let name = '';
    let name = document.getElementById("name").value?document.getElementById("name").value:'';
    console.log("from js:"+jsoon);
    // console.log(seats);
    if(jsoon != ''){
        if(window.XMLHttpRequest)
            var ajax = new XMLHttpRequest();
        else
            var ajax = new ActiveXObject("Microsoft.XMLHTTP");

        let method = "GET";
        let url = "/cmd_airline/seatlayouts/save/" + aircraftId + "/" + jsoon + "/" + name;
        let asynchronous = true;
        ajax.open(method, url, asynchronous);
        // ajax.setRequestHeader("Content-Type", "application/json");
        ajax.send(); //for post method
        //receiving response from db.php
        ajax.onreadystatechange = function(){
            //readystate
            //0: request not initialized
            //1: server connection established
            //2: request received
            //3: processing request
            //4: request finished and response is ready
            //status
            //200: "OK"
            //403: "Forbidden"
            //404: "Not Found"
            if(this.readyState == 4 && this.status == 200){
                // convert json back to array
                // let data = JSON.parse(this.responseText);
                // console.log("from ajax: " + data);
                console.log("from ajax: " + (this.responseText));
                let messageDiv = document.getElementById("responseMessage");
                while(messageDiv.lastChild) messageDiv.removeChild(messageDiv.lastChild);
                let resp =JSON.parse(this.responseText);

                if(resp.errorMessage != ""){
                    messageDiv.append(newElement("div",["alert", "alert-danger", "text-danger"],null,resp.errorMessage));

                }else{
                    location.reload();
                    messageDiv.innerHTML = (resp.message);
                }
            //    if(this.responseText == 1){
                    
                    // getAllAnswer();
                    // location.reload();
            //    }
            }
        }  
    }
}

let test = document.getElementById("test");
test.addEventListener("click", testFunction);
