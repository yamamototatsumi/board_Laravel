let main = document.getElementById('main');
let submit = document.getElementById('submit');

main.addEventListener('blur',function(){
  if(main.value===""){
    submit.disabled = true;
  }else{
    submit.disabled = false;
  }
})