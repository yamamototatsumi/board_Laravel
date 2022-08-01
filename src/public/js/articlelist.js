let keyword = document.getElementById('keyword');
let submit = document.getElementById('submit');

keyword.addEventListener('blur',function(){
  if(keyword.value===""){
    submit.disabled = true;
  }else{
    submit.disabled = false;
  }
})