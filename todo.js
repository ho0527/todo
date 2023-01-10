let start=document.getElementById("starttime")
let deal=document.getElementById("dealc")
let priority=document.getElementById("priorityc")
let uper=document.getElementById("uper")
let lower=document.getElementById("lower")
let user=document.getElementById("user-button")
let setting=document.getElementById("setting-button")
let loggout=document.getElementById("loggout-button")
let buttons=[start,deal,priority]// 將所有按鈕放在陣列中，方便後續使用

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

// 設定每個按鈕的點擊事件
buttons.forEach(function(button){
    button.onclick=function(){
        if(button.value=="升冪"){
            button.value="降冪"
        }else{
            button.value="升冪"
        }
        buttons.forEach(function(otherButton){
            if(otherButton!=button){
                otherButton.value="升冪"
            }
        })
        if(button.value=="升冪"){
            uper.style.display="inline"
            lower.style.display="none"
        }else{
            uper.style.display="none"
            lower.style.display="inline"
        }
    }
})