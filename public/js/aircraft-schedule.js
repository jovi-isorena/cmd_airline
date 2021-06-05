let aircraftSelectors = document.querySelectorAll(".aircraftSelector");
let layoutSelectors = document.querySelectorAll(".layoutSelector");
// console.log(aircraftSelectors);

aircraftSelectors.forEach( selector => {
    console.log(selector.getAttribute("link-to"));

    selector.addEventListener("change", (e)=>{
        let layoutSelector = document.getElementById(e.target.getAttribute("link-to"));
        // layoutSelector.appendChild(newElement("option", [],'','hello'));
        console.log(e.target.value);
        while(layoutSelector.lastElementChild != layoutSelector.children[0]) layoutSelector.removeChild(layoutSelector.lastChild);
        if(e.target.value != 0){
            if(window.XMLHttpRequest)
                var ajax = new XMLHttpRequest();
            else
                var ajax = new ActiveXObject("Microsoft.XMLHTTP");
    
            let method = "GET";
            let url = "/cmd_airline/seatlayouts/getLayoutsByAircraft/" + e.target.value;
            let asynchronous = true;
            ajax.open(method, url, asynchronous);
            ajax.send(); 
            ajax.onreadystatechange = function(){
               if(this.readyState == 4 && this.status == 200){
                    // convert json back to array
                    let data = JSON.parse(this.responseText);
                    console.log(data);
                    data.forEach(layout => {
                        let newOption = newElement("option", [],'',layout.name);
                        newOption.value = layout.id;
                        layoutSelector.appendChild(newOption);
                    });
                }
            }
        }
        else{
            while(e.target.lastChild != e.target.child[0]){
                e.target.removeChild(e.target.lastChild);
            }
        }
    });


});


layoutSelectors.forEach(layoutSelector => {
    layoutSelector.addEventListener("change", async (e)=>{
        console.log(e.target.value);
        let targetGrid = document.getElementById(e.target.getAttribute("link-to"));
        console.log(e.target.getAttribute("link-to"));
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
                    // document.getElementById("name").value = response.name;
                    let seats = JSON.parse(response.layout);
                    // rowCount = seats.length;
                    // colCount = seats[0].length;
                    console.table(seats);
                    redraw(targetGrid,seats);
                    // renameGrid(seats);
                }
            }
        }
    });
});

function createGrid(wrapper, seats) {
    let strClass = ["empty","economy","premium","business"]; 
    console.log("redraw");
    console.table(seats);
    let seatGrid = newElement("div",["seatgrid"]);
    
    for (let index = 0; index < seats.length; index++) {
        
        let newRow = newElement("div",["row"]);
        for (let index2 = 0; index2 < seats[index].length; index2++) {
           let newCol = newElement("div", ["box", strClass[seats[index][index2]]]);
           newRow.appendChild(newCol);
        }
        seatGrid.appendChild(newRow);
    }
    renameGrid(wrapper,seats);
    countSeats(seats);
    return seatGrid;
}

function redraw(wrapper, seats){
    console.log(wrapper);
    console.log(wrapper.children[1]);
    console.log(wrapper.children[1].children[1]);

    wrapper.children[1].children[1].removeChild(wrapper.children[1].children[1].lastChild);
    wrapper.children[1].children[1].appendChild(createGrid(wrapper,seats));
    // toStringArray(toNumberArray(seats));
    //STOPPED HERE ==============================================================================================
}
countSeats = (seats)=>{
    let eco = document.getElementById("economy_count");
    let pre = document.getElementById("premium_count");
    let bus = document.getElementById("business_count");
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
    // eco.innerText = eco_count;
    // pre.innerText = pre_count;
    // bus.innerText = bus_count;
    
    console.log(eco_count,pre_count,bus_count);

}
//naming the columns and rows
renameGrid = (wrapper,seats)=>{
    renameRow(wrapper, seats);
    renameCol(wrapper, seats);
};
//naming columns
renameCol = (wrapper, seats) => {
    xCoor = [];
    rowCount = seats.length;
    colCount = seats[0].length;
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
    console.log(xCoor);
    divXCoor = wrapper.children[0];
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
renameRow = (wrapper, seats) => {
    yCoor = [];
    console.log(seats); 
    rowCount = seats.length;
    colCount = seats[0].length;
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
    console.log(yCoor);
    divYCoor = wrapper.children[1].children[0];
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