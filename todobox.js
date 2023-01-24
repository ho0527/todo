let user=document.getElementById("user-button")
let setting=document.getElementById("setting-button")
let loggout=document.getElementById("loggout-button")

let workbox=document.getElementsByClassName("work-box")
let button=document.getElementsByClassName("todobut")
//訂定變數

user.style.display="inline"
setting.style.display="none"
loggout.style.display="none"

user.onclick=function(){
    user.style.display="none"
    setting.style.display="inline"
    loggout.style.display="inline"
}

for(let i=0;i<button.length;i=i+1){
    button[i].disabled=true//讓每個button都是disabled
}

for(let i=0;i<workbox.length;i=i+1){//做總workbox數
    workbox[i].addEventListener('click',function(){
        let buttons=this.querySelectorAll(".todobut")//選擇該todobut
        for(let i=0;i<button.length;i=i+1){
            button[i].disabled=true//將其他todobut disabled
        }
        for(let i=0;i<buttons.length;i=i+1){
            buttons[i].disabled=false//將該todobut disabled false
            setTimeout(function(){
                for(let j=0;j<button.length;j=j+1){
                    button[j].disabled=true //等待5秒設為true
                }
            },5000)
        }
        console.log(workbox[i]);
    })
}

let down=false
let move=false
document.querySelectorAll(".todo").forEach(function(element){
    element.addEventListener("mousedown",function(){
        down=true
    })
})
document.querySelectorAll(".todo").forEach(function(element){
    element.addEventListener("mousemove",function(event){
        if(down==true){
            move=true
        }
    })
})
document.querySelectorAll(".todo").forEach(function(element){
    element.addEventListener("mouseup",function(){
        if(move==true){
            location.href="useradd.php"
        }
    })
})

let boxid
var box
document.querySelectorAll('.work-box').forEach(function(element){
    element.addEventListener("mousedown",function(){
        console.log("mousedown")
        boxid=this.id//取得id
        console.log(boxid)
        down=false
        move=false
        box=document.querySelectorAll("#"+boxid)
        box.forEach(function(box){
            box.addEventListener("dragstart",dragstart)
        });
    })
})

let upusertablediv=document.querySelectorAll(".upusertablediv")

upusertablediv.forEach(function(up){
    up.addEventListener("dragenter",dragenter)
    up.addEventListener("dragover",dragover)
    up.addEventListener("dragleave",dragleave)
    up.addEventListener("drop",drop)
})


function dragstart(e){
    e.dataTransfer.setData("text",boxid)
    console.log("dragstart")
    console.log(boxid)
}

function dragenter(e){
    e.preventDefault()
    e.target.classList.add("drag-over")
}

function dragover(e){
    e.preventDefault()
    e.target.classList.add("drag-over")
}

function dragleave(e){
    e.preventDefault()
    e.target.classList.remove("drag-over")
}

function drop(e){
    e.preventDefault()
    e.target.classList.remove("drag-over")
    const id=e.dataTransfer.getData("text")
    const draggable=document.querySelectorAll("#"+id)
    console.log(id)
    document.querySelectorAll("#"+boxid)[0].style.top="0px"
    document.querySelectorAll("#"+boxid)[0].style.left="10px"
    let height=document.querySelectorAll("#"+boxid)[0].style.height
    console.log(height)
    let time=parseInt(height)/30
    console.log("time="+time)
    e.target.appendChild(draggable[0])
    draggable[0].addEventListener("dragstart",dragstart)
    console.log(e.target.id)
    let divtarget=parseFloat(e.target.id)
    console.log("divtarget="+divtarget)
    let hour=Math.floor(divtarget)
    console.log("hour="+hour)
    let min=(divtarget-hour)*60
    min=min.toFixed(0)
    if(hour<10){
        hour="0"+hour
    }
    if(min<10){
        min="0"+min
    }
    let starttime=hour+":"+min
    console.log("starttime="+starttime)
    document.getElementById(boxid+"starttime").innerHTML=`開始時間: ${starttime}`
    let endhr=parseInt(hour)+parseInt(time)
    let num=time
    let decimalonly=num%1*10
    console.log("decimalOnly="+decimalonly)
    let endmin=parseInt(min)+((decimalonly/5)*30)
    console.log("min="+min)
    if(endhr<10){
        endhr="0"+endhr
    }
    if(endmin<10){
        endmin="0"+endmin
    }
    if(endmin==60){
        endmin="00"
    }
    let endtime=endhr+":"+endmin
    document.getElementById(boxid+"endtime").innerHTML=`結束時間: ${endtime}`
    console.log("endmin="+endmin)
    console.log("endhr="+endhr)
}