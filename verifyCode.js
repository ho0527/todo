let dragimg=document.querySelectorAll(".dragimg")
let drops=document.querySelectorAll("#dropbox")
let a=[]
let b=["","",""]

dragimg.forEach(function(drag){
    drag.addEventListener("dragstart",dragstart)
})

drops.forEach(function(dropbox){
    dropbox.addEventListener("dragenter",drag)
    dropbox.addEventListener("dragover",drag)
    dropbox.addEventListener("dragleave",drag)
    dropbox.addEventListener("drop",drop)
})

function dragstart(event){
    event.dataTransfer.setData("text",event.target.id)
}

function drag(event){
    event.preventDefault()
}

function drop(event){
    let id=event.dataTransfer.getData("text")
    let draggable=document.getElementById(id)
    a.push(id)
    event.target.appendChild(draggable)
}

function loginclick(key){
    let username=document.getElementById("username").value
    let code=document.getElementById("code").value
    for(let i=0;i<3;i=i+1){
        b[i]=a[i]
    }
    if(key==0){
        b.sort()
        let temp=b[0]
        b[0]=b[2]
        b[2]=temp
        if(JSON.stringify(a)==JSON.stringify(b)){
            location.href="login.php?username="+username+"&code="+code
        }else{
            location.href="login.php?vererror=&username="+username+"&code="+code
        }
    }else{
        b.sort()
        if(JSON.stringify(a)==JSON.stringify(b)){
            location.href="login.php?username="+username+"&code="+code
        }else{
            location.href="login.php?vererror=&username="+username+"&code="+code
        }
    }
}