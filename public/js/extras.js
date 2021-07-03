const flightTabs = document.getElementsByClassName("flightTab");

for(const tab of flightTabs){
    tab.onclick= ()=>{
        console.log(tab.parentElement.parentElement);
        if(!tab.classList.contains("active")){
            for(const siblingTab of flightTabs){
                if(siblingTab != tab){
                    siblingTab.classList.remove("active");
                }
            }
            tab.classList.add("active");
            let pane = document.getElementById(tab.getAttribute("data-toggle"));
            for(const siblingPane of pane.parentElement.children){
                if(siblingPane != pane){
                    siblingPane.classList.add("d-none");
                }
            }
            pane.classList.remove("d-none");
        }
    }
}