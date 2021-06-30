let test = document.getElementById("test");
let data = [[1,2,3,4],[1,2,3],[6,7,8]];
test.addEventListener("click", ()=>{
    console.log('test');
    console.log(data);
    let js = JSON.stringify(data);
    console.log(js);
    

    if(js != ''){
        if(window.XMLHttpRequest)
            var ajax = new XMLHttpRequest();
        else
            var ajax = new ActiveXObject("Microsoft.XMLHTTP");

        let method = "GET";
        let url = "/cmd_airline/tests/index/1/" + js;
        // let url = "/cmd_airline/controllers/tests/index.php";
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
                
                // console.log("json parse: " + JSON.parse(this.responseText));
            //    if(this.responseText == 1){
                    
                    // getAllAnswer();
                    // location.reload();
            //    }
            }
        }
    }
});
