let postform = document.getElementsByClassName("postform")
let submit = document.getElementById('submit')

for(let i = 0; i<postform.length; i++){
  postform[i].addEventListener('blur',function(){
    console.log(postform[0].value)
    console.log(postform[1].value)
      if(postform[0].value==="" || postform[1].value===""){
        submit.disabled = true;
      }else{
        submit.disabled = false;
      }
  })
}




