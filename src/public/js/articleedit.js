let articleform = document.getElementsByClassName("articleform")
let submit = document.getElementById('submit')

for(let i = 0; i<articleform.length; i++){
  articleform[i].addEventListener('blur',function(){
    console.log(articleform[0].value)
    console.log(articleform[1].value)
      if(articleform[0].value==="" || articleform[1].value===""){
        submit.disabled = true;
      }else{
        submit.disabled = false;
      }
  })
}
