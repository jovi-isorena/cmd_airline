let rows = document.getElementById("rows");
let cols = document.getElementById("cols");
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
// let selectedLayout = document.getElementById("layouts").value;
function redraw(){
    gridWrapper.removeChild(gridWrapper.lastChild);
    gridWrapper.appendChild(createGrid());
    
}

layouts.addEventListener("change", async (e)=>{
    console.log(e.target.value);
    //fetch layout then generate
   if( e.target.value != 0){
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
                colCount = seats.length;
                rowCount = seats[0].length;
                console.table(seats);
                redraw();
                renameGrid();
            }
        }
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

//count seats
countSeats = ()=>{
    let eco = document.getElementById("economy_count");
    let pre = document.getElementById("premium_count");
    let bus = document.getElementById("business_count");
    let eco_count = 0, pre_count = 0, bus_count = 0, tot_count = 0;
    seats.map((seatRow) => {
        seatRow.map(seat => {
            switch (seat) {
                case "economy":
                    eco_count++;
                    tot_count++;
                    break;
                case "premium":
                    pre_count++;
                    tot_count++;
                    break;
                case "business":
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
    
    console.log(eco_count,pre_count,bus_count);

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
            if(seats[index2][index] != "empty"){
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
    console.log(xCoor);
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
            if(seats[index][index2] != "empty"){
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
    console.log(yCoor);
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
    
    console.log("redraw");
    console.table(seats);
    let seatGrid = newElement("div",["seatgrid"]);
    
    for (let index = 0; index < seats.length; index++) {
        
        let newRow = newElement("div",["row"]);
        for (let index2 = 0; index2 < seats[index].length; index2++) {
            
            let newCol = newElement("div", ["box", seats[index][index2]]);
           
            newCol.addEventListener("mousedown", (e)=>{
                mouseIsDown = true;
                radSeat.forEach(rad => {
                    if(rad.checked){
                        if(seats[index][index2] == rad.value){
                            seats[index][index2] = "empty";
                        }else{
                            seats[index][index2] = rad.value;
                        }
                        
                    }
                });
                redraw();
                renameGrid();
            });
            newCol.addEventListener("mouseup", (e)=>{
                mouseIsDown = false;
            });
            newCol.addEventListener("mouseenter", (e) =>{
                if(mouseIsDown){
                    radSeat.forEach(rad => {
                        if(rad.checked){
                            seats[index][index2] = rad.value;
                        }
                    });
                    redraw()
                    renameGrid();
                }
            });
            newRow.appendChild(newCol);
        }
        seatGrid.appendChild(newRow);
    }
    renameGrid();
    countSeats();
    return seatGrid;
}
createRow = () => {

}
addRows = (num) => {

}

generate.addEventListener("click", () =>{
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
                seats[i][j] = "empty";
            }
        }
        redraw()
    }
});
reset.addEventListener("click", () =>{
    
    for (let i = 0; i < rowCount; i++) {
        seats[i] = [];
        for (let j = 0; j < colCount; j++) {
            seats[i][j] = "empty";
            
        }
        
    }
    redraw()
});

//testing area
async function testFunction(){
    // let jsoon = JSON.stringify(seats);
    let jsoon = JSON.stringify(seats);
    let name = document.getElementById("name").value;
    console.log("from js:"+jsoon);
    // console.log(seats);
    if(jsoon != ''){
        if(window.XMLHttpRequest)
            var ajax = new XMLHttpRequest();
        else
            var ajax = new ActiveXObject("Microsoft.XMLHTTP");

        let method = "GET";
        let url = "/cmd_airline/seatlayouts/save/" + aircraftId + "/" + name + "/" + jsoon;
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
                if(this.responseText == "Success"){
                    location.reload();
                }else if(this.responseText == "Failed"){
                    alert("Failed to save.");
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
