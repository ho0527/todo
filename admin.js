let num=document.getElementById("num-up-down")
let user=document.getElementById("user-up-down")
let pass=document.getElementById("code-up-down")
let uname=document.getElementById("name-up-down")

let buttons=[num,user,pass,uname]

buttons.forEach(function(button){
    button.value="升冪"
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
    }
})

function submitbut(){
    console.log(user.value)
    location.href="adminWelcome.php?up_down=&num-up-down="+num.value+"&user-up-down="+user.value+"&code-up-down="+pass.value+"&name-up-down="+uname.value
}