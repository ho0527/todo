let today=new Date()
let date=document.getElementById("date")
let day
let month

if(today.getDate()<10){
    day=("0"+today.getDate())
}else{
    day=today.getDate()
}

if(today.getMonth()+1<10){
    month=("0"+(today.getMonth()+1))
}else{
    month=today.getMonth()+1
}

let todaydate=(today.getFullYear()+"-"+month+"-"+day)

date.value=todaydate