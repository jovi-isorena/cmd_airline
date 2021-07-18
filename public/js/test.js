// const txtOrigin = document.getElementById("origin");
// const txtDestination = document.getElementById("destination");
const inputs = document.querySelectorAll(".airportInput");

inputs.forEach((input)=>{
    input.onkeyup = ()=>{
        suggestTab = document.getElementById(input.getAttribute("data-link"));
        while(suggestTab.lastChild) suggestTab.removeChild(suggestTab.lastChild);
        console.log(input.value.trim());
        // check if value is not null before fetching
        if(input.value.trim() != ""){
            if(window.XMLHttpRequest)
                var ajax = new XMLHttpRequest();
            else
                var ajax = new ActiveXObject("Microsoft.XMLHTTP");
    
                let method = "GET";
                let url = "/cmd_airline/tests/fetchAirport/" + input.value.trim();
                let asynchronous = true;
                ajax.open(method, url, asynchronous);
                ajax.send(); //for post method
                ajax.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        console.log("from ajax: " + (this.responseText));
                        let resp =JSON.parse(this.responseText);
                        console.table(resp);
                        
                        resp.forEach((airport)=>{
                            const newItem = document.createElement("button");
                            newItem.setAttribute("type", "button");
                            newItem.classList.add("list-group-item", "list-group-item-action");
                            const spanName = document.createElement("span");
                            spanName.innerText = airport['airport_code'] + " - " + airport['name'];
                            const spanAddr = document.createElement("span");
                            spanAddr.innerText = airport['address'];
                            newItem.append(spanName);
                            newItem.append(document.createElement("br"));
                            newItem.append(spanAddr);

                            suggestTab.append(newItem);
                        });
                        
                    }
                }  
        }
    }
    
})

// <button type="button" class="list-group-item list-group-item-action">
//     <span>MNL - Ninoy Aquino International Airport</span><br>
//     <span>Pasay, Philippines</span>
// </button>


