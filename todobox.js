let workbox=document.getElementsByClassName("work-box")
let button=document.getElementsByClassName("todobut")
//訂定變數

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

// let down=false
// let move=false
// document.querySelectorAll(".todo").forEach(function(element){
//     element.addEventListener("mousedown",function(){
//         down=true
//     })
// })
// document.querySelectorAll(".todo").forEach(function(element){
//     element.addEventListener("mousemove",function(event){
//         if(down==true){
//             move=true
//         }
//     })
// })
// document.querySelectorAll(".todo").forEach(function(element){
//     element.addEventListener("mouseup",function(){
//         if(move==true){
//             location.href="useradd.php"
//         }
//     })
// })

// let boxid=undefined
// document.querySelectorAll('.work-box').forEach(function(element){
//     element.addEventListener("mousedown",function(){
//         console.log("mousedown")
//         boxid=this.id//取得id
//         down=false
//         move=false
//     })
// })
// document.querySelectorAll(".todo").forEach(function(element){
//     element.addEventListener("mousemove",function(event){
//         console.log("mousemove")
//         if(boxid==undefined){
//             return
//         }
//         let box=document.getElementById(boxid)
//         let y=event.pageY//返回事件相對於整個文檔的 Y（垂直）坐標（以像素為單位）
//         let start=Math.floor((y-145)/60)//向下取整
//         // console.log("height="+(box.style.height))
//         let height=parseFloat(box.style.height.replace("px",""))/50
//         // console.log("height="+height)
//         if(start<0){
//             start=0
//         }
//         if(start+height>48){
//             start=48-height
//         }
//         let end=start+height
//         let top=start*50+110
//         box.style.top=top
//         if(start%2==0){
//             start=String(start/2).padStart(2,"0")+":00"
//         }else{
//             start=String(start/2- 0.5).padStart(2,"0")+":30"
//         }
//         if(end%2==0){
//             end=String(end/2).padStart(2,"0")+":00"
//         }else{
//             end=String(end/2- 0.5).padStart(2,"0")+":30"
//         }
//     })
// })
// document.querySelectorAll(".todo").forEach(function(element){
//     element.addEventListener("mouseup",function(){
//         console.log("up")
//         let box=document.getElementById(boxid)
//         let height=parseFloat(box.style.height.replace("px",""))/50
//         let start=parseFloat(box.style.top.replace("px","")-110)/50
//         let end=start+height
//         let xhr=new XMLHttpRequest()
//         xhr.open("GET","userWelcome.php?boxid="+boxid+"&start="+start+"&end="+end,true)
//         xhr.onreadystatechange=function(){
//             if(xhr.readyState==4&&xhr.status==200){
//                 // location.reload()
//             }
//         }
//         xhr.send()
//     })
// })

let boxid=undefined
$('.work-box').on("mousedown",function(){
    console.log("down")
    boxid=this.id
})
$("body").on("mousemove",function(event){
    console.log("mousemove")
    if(boxid==undefined){
        return
    }
    let box=document.getElementById(boxid)
    let y=event.pageY
    let start=Math.floor((y-100)/50)
    let height=box.css("height").replace("px","")/50
    if(start<0){
        start=0
    }
    if(start+height>48){
        start=48-height
    }
    let end=start+height
    let top=start*50+110
    box.css("top",top)
    start=(start%2==0)?String(start/2).padStart(2,"0")+":00":String(start/2-0.5).padStart(2,"0")+":30"
    end=(end%2==0)?String(end/2).padStart(2,"0")+":00":String(end/2-0.5).padStart(2,"0")+":30"
})
$("body").on("mouseup",function(event){
    console.log("up")
    let box=document.getElementById(boxid)
    let height=box.css("height").replace("px","")/50
    let start=(box.css("height").replace("px","")-110)/50
    let end=start+height
    $.ajax({
        url:"userWelcome.php?boxid="+boxid+"&start="+start+"&end="+end,
        type:"get",
        success: function(){
            //location.reload()
        }
    })
})
