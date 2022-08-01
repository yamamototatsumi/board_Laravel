let pass1 = document.getElementById('pass1')
let pass2 = document.getElementById('pass2')
let nickname = document.getElementById('nickname')
let error_result = document.getElementsByClassName('error_result')
let submit = document.getElementById('submit')
let inputform = document.getElementsByClassName('inputform')

function mail_errorcheck(A){
  let flag=false;
  if((!String(A).match(/^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@{1}[A-Za-z0-9_.-]+.[A-Za-z0-9]+$/))){
    flag=true;
  }
  return flag;
}

function pass_errorcheck(A){
  let flag=false;
  if((!String(A).match(/^([a-zA-Z0-9]{10,})$/))){
    flag=true;
  }
  return flag;
}

function pass_re_errorcheck(){
  let flag=false;
  if(pass1.value===pass2.value){
    flag=true;
  }
  return flag;
}

function name_errorcheck(A){
  let flag=false;
  if((!String(A).match(/^([a-zA-Z0-9]{8,})$/))){
    flag=true;
  }
  return flag;
}

function all_errorcheck(A){
  let flag=false;
  for(let i = 0; i<A.length; i++){
    if(!A[i].value===""){
      flag = true;
      return flag;
    }
  }
  return flag;
}

pass1.addEventListener('blur',function(){
  if(pass_errorcheck(pass1.value)){
    error_result[1].innerHTML="有効なパスワードを入力して下さい。"
  }else{
    error_result[1].innerHTML=""
  }
})

pass2.addEventListener('blur',function(){
  if(!pass_re_errorcheck()){
    error_result[2].innerHTML="上と同じパスワードを入力して下さい"
  }else{
    error_result[2].innerHTML=""
  }
})

nickname.addEventListener('blur',function(){
  if(name_errorcheck(nickname.value)){
    error_result[3].innerHTML="有効な文字を入力してください"
  }else{
    error_result[3].innerHTML=""
  }
})

for(let i = 0; i<inputform.length; i++){
  inputform[i].addEventListener('blur',function(){
      if(all_errorcheck(inputform)){
        submit.disabled = true;
        return
      }else{
        submit.disabled = false;
    }
  })
}



