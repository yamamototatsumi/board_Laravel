let newname = document.getElementById('newname')
let oldpass = document.getElementById('oldpass') 
let newpass = document.getElementById('newpass')
let ca_submit = document.getElementById('change_acount_submit')
let ca_error_result = document.getElementsByClassName('change_acount_error_result')
let ca_inputform = document.getElementsByClassName('ca_inputform')

function name_errorcheck(A){
  let flag=false;
  if((!String(A).match(/^([a-zA-Z0-9]{8,})$/))){
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

function all_errorcheck(){
  let flag =false
  for(let i = 0; i<ca_inputform.length; i++){
    console.log(ca_error_result[i].value)
    if(!(ca_error_result[i].innerHTML==="")){//エラーテキストが出てたら
      flag = true;//trueになる
      return flag;//一個でもあれば終わり
    }
    else{
      flag= false
    }
  }
  return flag;
}

newname.addEventListener('blur',function(){
  if(name_errorcheck(newname.value)){
    ca_error_result[0].innerHTML="有効な文字を入力してください"
  }else{
    ca_error_result[0].innerHTML=""
  }
})

oldpass.addEventListener('blur',function(){
  if(pass_errorcheck(oldpass.value)){
    ca_error_result[1].innerHTML="有効なパスワードを入力して下さい。"
  }else{
    ca_error_result[1].innerHTML=""
  }
})

newpass.addEventListener('blur',function(){
  if(pass_errorcheck(newpass.value)){
    ca_error_result[2].innerHTML="有効なパスワードを入力して下さい。"
  }else{
    ca_error_result[2].innerHTML=""
  }
})

for(let i = 0; i<ca_inputform.length; i++){
  ca_inputform[i].addEventListener('blur',function(){
    console.log(all_errorcheck())
      if(all_errorcheck()){
        ca_submit.disabled = true;
      }else{
        ca_submit.disabled = false;
    }   
  })
}
