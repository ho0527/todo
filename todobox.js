let todoeditblock=document.getElementsByTagName("div")
let button=document.getElementsByClassName("todobut")

for(let i=0;i<button.length;i=i+1){
    button[i].disabled=true
}

for(let i=0;i<todoeditblock.length;i=i+1){
    todoeditblock[i].addEventListener('click',function(){
        let buttons=this.querySelectorAll(".todobut")
        for(let i=0;i<button.length;i=i+1){
            button[i].disabled=true
        }
        for(let i=0;i<buttons.length;i=i+1){
            buttons[i].disabled=false
            setTimeout(function(){
                for(let j=0;j<button.length;j=j+1){
                    button[j].disabled=true
                }
            },5000)
        }
        console.log(todoeditblock[i]);
    })
}