let start=document.getElementById("starttime")
let uper=document.getElementById("uper")
let lower=document.getElementById("lower")
let user=document.getElementById("user-button")
let setting=document.getElementById("setting-button")
let loggout=document.getElementById("loggout-button")

let num=document.getElementById("num-up-down")
let title=document.getElementById("title-up-down")
let time=document.getElementById("time-up-down")
let dateud=document.getElementById("date-up-down")
let dealud=document.getElementById("deal-up-down")
let priorityud=document.getElementById("priority-up-down")

let updown=[num,title,time,dateud,dealud,priorityud]// 將所有按鈕放在陣列中，方便後續使用

user.style.display="inline"
setting.style.display="none"
loggout.style.display="none"
uper.style.display="inline"
lower.style.display="none"

user.onclick=function(){
    user.style.display="none"
    setting.style.display="inline"
    loggout.style.display="inline"
}


start.onclick=function(){
    if(start.value=="升冪"){
        start.value="降冪"
        uper.style.display="inline"
        lower.style.display="none"
    }else{
        start.value="升冪"
        uper.style.display="none"
        lower.style.display="inline"
    }
}

updown.forEach(function(buttons){
    buttons.value="升冪"
    buttons.onclick=function(){
        if(buttons.value=="升冪"){
            buttons.value="降冪"
        }else{
            buttons.value="升冪"
        }
        updown.forEach(function(otherButton){
            if(otherButton!=buttons){
                otherButton.value="升冪"
            }
        })
    }
})

function submitbut(){
    console.log(user.value)
    location.href="userWelcome.php?up_down=&num-up-down="+num.value+"&title-up-down="+title.value+"&time-up-down="+time.value+"&date-up-down="+dateud.value+"&deal-up-down="+dealud.value+"&priority-up-down="+priorityud.value
}