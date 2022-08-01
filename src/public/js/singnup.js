let email = document.getElementById('email')
let error_result = document.getElementsByClassName('error_result')
let submit = document.getElementById('submit')

function mail_errorcheck(A){
  let flag=false;
  if((!String(A).match(/^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@{1}[A-Za-z0-9_.-]+.[A-Za-z0-9]+$/))){
    flag=true;
  }
  return flag;
}

email.addEventListener('blur',function(){
  if(mail_errorcheck(email.value)){
    error_result[0].innerHTML="正しいアドレスを入力してください"
    submit.disabled = true;
  }else{
    error_result[0].innerHTML=""
    submit.disabled = false;
  }
})





