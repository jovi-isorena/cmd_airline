let aircraftSelectors = document.querySelectorAll(".aircraftSelector");
let layoutSelectors = document.querySelectorAll(".layoutSelector");
let oneForAll = document.getElementById("oneForAll");
let test = document.getElementById("test");
// console.log(aircraftSelectors);

// test.addEventListener("click", ()=>{
//     console.log(typeof(aircraftSelectors.children));
//     console.log(aircraftSelectors.children.filter(sel=> sel.children.map(opt => opt.value == 1)));
// });

window.addEventListener("load", ()=>{
    // aircraftSelectors[0].selectedIndex = 1;
    // aircraftSelectors[0].dispatchEvent(new Event('change', {bubbles:true}));
    // layoutSelectors[0].selectedIndex = 1;
    // layoutSelectors[0].dispatchEvent(new Event('change', {bubbles:true}));
});
//checkbox eventlistener. for enabling and disabling selections
oneForAll.addEventListener("change", ()=>{
    aircraftSelectors.forEach(acs=>{
        // console.log(oneForAll.checked);
        if(acs != aircraftSelectors[0]){
            acs.disabled = oneForAll.checked;
        }
    });
    layoutSelectors.forEach(lcs=>{
        // console.log(oneForAll.checked);
        if(lcs != layoutSelectors[0]){
            lcs.disabled = oneForAll.checked;
        }
    });
});

//adding event listener to all aircraft selectors
aircraftSelectors.forEach( selector => {
    console.log(selector.getAttribute("link-to"));

    selector.addEventListener("change", (e)=>{
        //if oneForAll is checked, apply function to first child selector
        if( oneForAll.checked && e.target == aircraftSelectors[0]){
            aircraftSelectors.forEach(sel => {
                if(sel != e.target){
                    sel.value = e.target.value;
                    sel.dispatchEvent(new Event('change'));
                }
            });
        }
        //adds option elements using ajax
        let layoutSelector = document.getElementById(e.target.getAttribute("link-to"));
        console.log(e.target.value);
        while(layoutSelector.lastElementChild != layoutSelector.children[0]) layoutSelector.removeChild(layoutSelector.lastChild);
        layoutSelector.dispatchEvent(new Event('change'));
        
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
            console.log(layoutSelector);
            while(layoutSelector.lastChild != layoutSelector.children[0]){
                layoutSelector.removeChild(layoutSelector.lastChild);
            }
            // e.target.dispatchEvent(new Event('change'));
        }
    });


});

//adding event listener to all layout selectors
layoutSelectors.forEach(layoutSelector => {
    layoutSelector.addEventListener("change", async (e)=>{
        //if oneForAll is checked, apply function to first child selector
        if( oneForAll.checked && e.target == layoutSelectors[0]){
            console.log("test");
            layoutSelectors.forEach(sel => {
                if(sel != e.target){
                    sel.value = e.target.value;
                    sel.dispatchEvent(new Event('change'));
                }
            });
        }

        console.log(e.target.value);
        let targetGrid = document.getElementById(e.target.getAttribute("link-to"));
        if( e.target.value != 0){
            if(window.XMLHttpRequest)
                var ajax = new XMLHttpRequest();
            else
                var ajax = new ActiveXObject("Microsoft.XMLHTTP");
    
            let method = "GET";
            let url = "/cmd_airline/seatlayouts/getLayoutById/" + e.target.value;
            let asynchronous = true;
            ajax.open(method, url, asynchronous);
            ajax.send(); //for post method
            ajax.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){

                    let response =JSON.parse(this.responseText);
                    let seats = JSON.parse(response.layout);
                    redraw(targetGrid,seats); //draws the layout
                }
            }
        }else{
            clearGrid(targetGrid); //reset the grid if there is no layout
            // e.target.dispatchEvent(new Event('change'));

        }
    });
});
async function clearGrid(wrapper){
    while(wrapper.children[0].lastChild) wrapper.children[0].removeChild(wrapper.children[0].lastChild); //removes xCoor
    while(wrapper.children[1].children[0].lastChild) wrapper.children[1].children[0].removeChild(wrapper.children[1].children[0].lastChild); //removes yCoor
    wrapper.children[1].children[1].removeChild(wrapper.children[1].children[1].lastChild); //removes grid
}

function createGrid(wrapper, seats) {
    let strClass = ["empty","economy","premium","business"]; 
    // console.log("redraw");
    // console.table(seats);
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
    
    while(wrapper.children[1].children[1].lastChild) wrapper.children[1].children[1].removeChild(wrapper.children[1].children[1].lastChild);
    wrapper.children[1].children[1].appendChild(createGrid(wrapper,seats));
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
    // console.log(xCoor);
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
    // console.log(seats); 
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
    // console.log(yCoor);
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