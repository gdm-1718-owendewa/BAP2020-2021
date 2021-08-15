if(document.getElementById('tutorial-create-div')){
   let dropdownresults = document.getElementById('imagedropdown');
   let dropdownButton;
   if(document.getElementById('openDropdownButton') != undefined || document.getElementById('openDropdownButton') != null){
      dropdownButton = document.getElementById('openDropdownButton');
      dropdownButton.addEventListener('click', ()=>{
      document.getElementById('imagedropdown').classList.toggle('notactive')
      })
   }
   let dorpdownimages = document.querySelectorAll('.tutorial-dropdown-image');
   dorpdownimages.forEach(element => {
      element.addEventListener('click', ()=>{
         var input_temp = document.createElement("input");
         input_temp.value = element.src;
         document.body.appendChild(input_temp);
         input_temp.select();
         document.execCommand("copy");
         document.body.removeChild(input_temp);
         createNotification();
         document.getElementById('imagedropdown').classList.add('notactive')
      })
   });
   function createNotification(){
      const notif = document.createElement('div');
      notif.classList.add('notif');
      document.getElementsByTagName('main')[0].appendChild(notif);
      notif.innerText = 'gekopieerd naar clipboard'
      setTimeout(()=>{
         notif.remove();
      }, 3000)
   }
   document.getElementById('imagedropdown-close-button').addEventListener('click', ()=>{
      dropdownresults.classList.add('notactive')
   })
   let tuttype;
   function validateForm(){
      if(titleCheck && thumbnailCheck && descriptionCheck && kindCheck){
         if(tuttype == 'video'){
            if(mainvideoCheck){
               button.disabled = false
               button.style.backgroundColor= ""
            }else{
               button.disabled = true
               button.style.backgroundColor= "grey"
            }
         }
         if(tuttype == 'mixed'){
            if(mainvideoCheck && contentCheck){
               button.disabled = false
               button.style.backgroundColor= ""
            }else{
               button.disabled = true
               button.style.backgroundColor= "grey"
            }
         }
         if(tuttype == 'written'){
            if(contentCheck){
               button.disabled = false
               button.style.backgroundColor= ""
            }else{
               button.disabled = true
               button.style.backgroundColor= "grey"
            }
         }
      }else{
         button.disabled = true
         button.style.backgroundColor= "grey"
      }
   }
   let button = document.querySelector('#submit')
   button.disabled = true
   button.style.backgroundColor= "grey"
   let title = document.getElementById('title');
   let titleCheck = false;
   document.getElementById('titleSpan').innerHTML = '<i class="fas fa-times"></i>'
   document.getElementById('titleSpan').style.color = "red"
   title.addEventListener('input', (e) => {
      if(title.value.length > 0 && title.value.length < 100){
         titleCheck = true;
         document.getElementById('titleSpan').innerHTML = '<i class="fas fa-check"></i>'
         document.getElementById('titleSpan').style.color = "green"

      }else{
         titleCheck = false;
         document.getElementById('titleSpan').innerHTML = '<i class="fas fa-times"></i>'
         document.getElementById('titleSpan').style.color = "red"
      }
      validateForm();
   })
   let thumbnailCheck = false;
   document.getElementById('thumbnailSpan').innerHTML = '<i class="fas fa-times"></i>'
   document.getElementById('thumbnailSpan').style.color = "red"
   let thumbnail = document.getElementById('video-thumbnail');
   thumbnail.addEventListener('change', (e)=>{ 
      if(thumbnail.files.length != 0){
         thumbnailCheck = true
         document.getElementById('thumbnailSpan').innerHTML = '<i class="fas fa-check"></i>'
         document.getElementById('thumbnailSpan').style.color = "green"
      }else{
         thumbnailCheck = false
         document.getElementById('thumbnailSpan').innerHTML = '<i class="fas fa-times"></i>'
         document.getElementById('thumbnailSpan').style.color = "red"
      }
      validateForm();
   })
   let description = document.getElementById('description');
   let descriptionCheck = false;
   document.getElementById('descriptionSpan').innerHTML = '<i class="fas fa-times"></i>'
   document.getElementById('descriptionSpan').style.color = "red"
   function foo() {
      let contentLength = description.getAttribute('data-length');
      if(contentLength <= 99 ){
         descriptionCheck = false;
         document.getElementById('descriptionSpan').innerHTML = '<i class="fas fa-times"></i>'
         document.getElementById('descriptionSpan').style.color = "red"
         setTimeout(foo, 2000);
      }
      else if(contentLength > 99){
         descriptionCheck = true;
         document.getElementById('descriptionSpan').innerHTML = '<i class="fas fa-check"></i>'
         document.getElementById('descriptionSpan').style.color = "green"
         setTimeout(foo, 2000);
      }
      validateForm();
   }
   foo();

   let videobutton = document.getElementById('video-type');
   let mixedbutton = document.getElementById('mixed-type');
   let writtenbutton = document.getElementById('written-type');
   let kindCheck = false;
   let file_div = document.getElementById('tutorial-file-div');
   let written_div = document.getElementById('tutorial-written-div');
   let mainvideo = document.getElementById('main-video');
   let mainvideoCheck = false;
   let content = document.getElementById('inhoud');
   let contentCheck = false;
   let text = false;
   function fooContent() {
      if(text){
         let contentLength = content.getAttribute('data-length');
         if(contentLength <= 99 ){
            contentCheck = false;
            document.getElementById('tutcontentSpan').innerHTML = '<i class="fas fa-times"></i>'
            document.getElementById('tutcontentSpan').style.color = "red"
            setTimeout(fooContent, 2000);
         }
         else if(contentLength > 99){
            contentCheck = true;
            document.getElementById('tutcontentSpan').innerHTML = '<i class="fas fa-check"></i>'
            document.getElementById('tutcontentSpan').style.color = "green"
            setTimeout(fooContent, 2000);
         }
         validateForm()
      }
   }


   //Check welk soort tutorial je hebt aangeduid om zo de juiste velden te tonen
   document.getElementById('kindSpan').innerHTML = '<i class="fas fa-times"></i>'
   document.getElementById('kindSpan').style.color = "red"

   if(videobutton){
      videobutton.addEventListener('click', ()=>{
         kindCheck = true;
         file_div.style.display="block";
         written_div.style.display ="none";
         mainvideo.value = null;
         mainvideoCheck = false;
         document.getElementById('kindSpan').innerHTML = '<i class="fas fa-check"></i>'
         document.getElementById('kindSpan').style.color = "green"
         document.getElementById('tutvideoSpan').innerHTML = '<i class="fas fa-times"></i>'
         document.getElementById('tutvideoSpan').style.color = "red"
         text = false;
         tuttype = 'video'
         validateForm()
      });
      mixedbutton.addEventListener('click', ()=>{
         kindCheck = true;
         file_div.style.display="block";
         written_div.style.display ="block";
         mainvideo.value = null;
         mainvideoCheck = false;
         document.getElementById('kindSpan').innerHTML = '<i class="fas fa-check"></i>'
         document.getElementById('kindSpan').style.color = "green"
         document.getElementById('tutvideoSpan').innerHTML = '<i class="fas fa-times"></i>'
         document.getElementById('tutvideoSpan').style.color = "red"
         document.getElementById('tutcontentSpan').innerHTML = '<i class="fas fa-times"></i>'
         document.getElementById('tutcontentSpan').style.color = "red"
         text = true;
         tuttype = 'mixed'
         fooContent();
      });
      writtenbutton.addEventListener('click', ()=>{
         kindCheck = true;
         file_div.style.display="none";
         written_div.style.display ="block";
         document.getElementById('kindSpan').innerHTML = '<i class="fas fa-check"></i>'
         document.getElementById('kindSpan').style.color = "green"
         document.getElementById('tutcontentSpan').innerHTML = '<i class="fas fa-times"></i>'
         document.getElementById('tutcontentSpan').style.color = "red"
         text = true;
         tuttype = 'written'
         fooContent();
      });
   }

   mainvideo.addEventListener('change', (e)=>{
      if(mainvideo.files.length != 0){
         mainvideoCheck = true
         document.getElementById('tutvideoSpan').innerHTML = '<i class="fas fa-check"></i>'
         document.getElementById('tutvideoSpan').style.color = "green"
      }else{
         mainvideoCheck = false
         document.getElementById('tutvideoSpan').innerHTML = '<i class="fas fa-times"></i>'
         document.getElementById('tutvideoSpan').style.color = "red"
      }
      validateForm()
   })
}
////////////////////////////////////////////////////
//                     EDIT                       //
////////////////////////////////////////////////////

if(document.getElementById('tutorial-edit-div')){
   let dropdownresults = document.getElementById('imagedropdown');
   if(document.getElementById('openDropdownButton') != undefined || document.getElementById('openDropdownButton') != null){
      dropdownButton = document.getElementById('openDropdownButton');
      dropdownButton.addEventListener('click', ()=>{
      document.getElementById('imagedropdown').classList.toggle('notactive')
      })
   }
   let dorpdownimages = document.querySelectorAll('.tutorial-dropdown-image');
   dorpdownimages.forEach(element => {
      element.addEventListener('click', ()=>{
         var input_temp = document.createElement("input");
         input_temp.value = element.src;
         document.body.appendChild(input_temp);
         input_temp.select();
         document.execCommand("copy");
         document.body.removeChild(input_temp);
         createNotification();
         document.getElementById('imagedropdown').classList.add('notactive')
      })
   });
   function createNotification(){
      const notif = document.createElement('div');
      notif.classList.add('notif');
      document.getElementsByTagName('main')[0].appendChild(notif);
      notif.innerText = 'gekopieerd naar clipboard'
      setTimeout(()=>{
         notif.remove();
      }, 3000)
   }
   document.getElementById('imagedropdown-close-button').addEventListener('click', ()=>{
      dropdownresults.classList.add('notactive')
   })
   let tuttype;
   if (document.getElementById('video-type').checked) {
      tuttype = 'video'
      mainvideoCheck = true;
    }
    if (document.getElementById('written-type').checked) {
      tuttype = 'written'
      text = true;

    }
    if (document.getElementById('mixed-type').checked) {
      tuttype = 'mixed'
      mainvideoCheck = true;
      text = true;

    }
   let button = document.querySelector('#submit')
   function validateForm(){
      if(titleCheck && thumbnailCheck && descriptionCheck && kindCheck){
         if(tuttype == 'video'){
            if(mainvideoCheck){
               button.disabled = false
               button.style.backgroundColor= ""
            }else{
               button.disabled = true
               button.style.backgroundColor= "grey"
            }
         }
         if(tuttype == 'mixed'){
            if(mainvideoCheck && contentCheck){
               button.disabled = false
               button.style.backgroundColor= ""
            }else{
               button.disabled = true
               button.style.backgroundColor= "grey"
            }
         }
         if(tuttype == 'written'){
            if(contentCheck){
               button.disabled = false
               button.style.backgroundColor= ""
            }else{
               button.disabled = true
               button.style.backgroundColor= "grey"
            }
         }
      }else{
         button.disabled = true
         button.style.backgroundColor= "grey"
      }
   }

   let title = document.getElementById('title');
   let titleCheck = true;
   document.getElementById('titleSpan').innerHTML = '<i class="fas fa-check"></i>'
   document.getElementById('titleSpan').style.color = "green"
   title.addEventListener('input', (e) => {
      if(title.value.length > 0 && title.value.length < 100){
         titleCheck = true;
         document.getElementById('titleSpan').innerHTML = '<i class="fas fa-check"></i>'
         document.getElementById('titleSpan').style.color = "green"

      }else{
         titleCheck = false;
         document.getElementById('titleSpan').innerHTML = '<i class="fas fa-times"></i>'
         document.getElementById('titleSpan').style.color = "red"
      }
      validateForm();

   })
   let thumbnailCheck = true;
   document.getElementById('thumbnailSpan').innerHTML = '<i class="fas fa-check"></i>'
   document.getElementById('thumbnailSpan').style.color = "green"
   let thumbnail = document.getElementById('video-thumbnail');
   thumbnail.addEventListener('change', (e)=>{ 
      if(thumbnail.files.length != 0){
         thumbnailCheck = true
         document.getElementById('thumbnailSpan').innerHTML = '<i class="fas fa-check"></i>'
         document.getElementById('thumbnailSpan').style.color = "green"
      }else{
         thumbnailCheck = false
         document.getElementById('thumbnailSpan').innerHTML = '<i class="fas fa-times"></i>'
         document.getElementById('thumbnailSpan').style.color = "red"
      }
      validateForm();

   })

   let description = document.getElementById('description');
   let descriptionCheck = true;
   document.getElementById('descriptionSpan').innerHTML = '<i class="fas fa-check"></i>'
   document.getElementById('descriptionSpan').style.color = "green"
   function foo() {
      let contentLength = description.getAttribute('data-length');
      if(contentLength <= 99 ){
         descriptionCheck = false;
         document.getElementById('descriptionSpan').innerHTML = '<i class="fas fa-times"></i>'
         document.getElementById('descriptionSpan').style.color = "red"
         setTimeout(foo, 2000);
      }
      else if(contentLength > 99){
         descriptionCheck = true;
         document.getElementById('descriptionSpan').innerHTML = '<i class="fas fa-check"></i>'
         document.getElementById('descriptionSpan').style.color = "green"
         setTimeout(foo, 2000);
      }
      validateForm();

   }
   foo();


   let videobutton = document.getElementById('video-type');
   let mixedbutton = document.getElementById('mixed-type');
   let writtenbutton = document.getElementById('written-type');
   let kindCheck = true;
   let file_div = document.getElementById('tutorial-file-div');
   let written_div = document.getElementById('tutorial-written-div');
   let mainvideo = document.getElementById('main-video');
   let mainvideoCheck = false;
   let content = document.getElementById('inhoud');
   let contentCheck = false;
   let text = false;
   function fooContent() {
      if(text){
         let contentLength = content.getAttribute('data-length');
         if(contentLength <= 99 ){
            contentCheck = false;
            document.getElementById('tutcontentSpan').innerHTML = '<i class="fas fa-times"></i>'
            document.getElementById('tutcontentSpan').style.color = "red"
            setTimeout(fooContent, 2000);
         }
         else if(contentLength > 99){
            contentCheck = true;
            document.getElementById('tutcontentSpan').innerHTML = '<i class="fas fa-check"></i>'
            document.getElementById('tutcontentSpan').style.color = "green"
            setTimeout(fooContent, 2000);
         }
         validateForm();
      }  
   }


   //Check welk soort tutorial je hebt aangeduid om zo de juiste velden te tonen
   document.getElementById('kindSpan').innerHTML = '<i class="fas fa-check"></i>'
   document.getElementById('kindSpan').style.color = "green"

    if(tuttype == 'mixed'){
      document.getElementById('kindSpan').innerHTML = '<i class="fas fa-check"></i>'
      document.getElementById('kindSpan').style.color = "green"
      document.getElementById('tutvideoSpan').innerHTML = '<i class="fas fa-check"></i>'
      document.getElementById('tutvideoSpan').style.color = "green"
      document.getElementById('tutcontentSpan').innerHTML = '<i class="fas fa-check"></i>'
      document.getElementById('tutcontentSpan').style.color = "green"
      text = true;
      mainvideoCheck = true;
      fooContent();

    }
    if(tuttype == 'video'){
      document.getElementById('kindSpan').innerHTML = '<i class="fas fa-check"></i>'
      document.getElementById('kindSpan').style.color = "green"
      document.getElementById('tutvideoSpan').innerHTML = '<i class="fas fa-check"></i>'
      document.getElementById('tutvideoSpan').style.color = "green"
      mainvideoCheck = true;
      validateForm();

    }
    if(tuttype == 'written'){
      document.getElementById('kindSpan').innerHTML = '<i class="fas fa-check"></i>'
      document.getElementById('kindSpan').style.color = "green"
      document.getElementById('tutcontentSpan').innerHTML = '<i class="fas fa-check"></i>'
      document.getElementById('tutcontentSpan').style.color = "green"
      text = true;
      fooContent();

    }




   if(videobutton){
      videobutton.addEventListener('click', ()=>{
         kindCheck = true;
         file_div.style.display="block";
         written_div.style.display ="none";
         mainvideo.value = null;
         if(document.getElementById('tutorial-edit-video-prev')){
            mainvideoCheck = true;
         }else{
            mainvideoCheck = false;
            document.getElementById('tutvideoSpan').innerHTML = '<i class="fas fa-times"></i>'
            document.getElementById('tutvideoSpan').style.color = "red"
         }
         text = false;
         tuttype = 'video'
         validateForm();

      });
      mixedbutton.addEventListener('click', ()=>{
         kindCheck = true;
         file_div.style.display="block";
         written_div.style.display ="block";
         mainvideo.value = null;
         if(document.getElementById('tutorial-edit-video-prev')){
            mainvideoCheck = true;
         }else{
            mainvideoCheck = false;
            document.getElementById('tutvideoSpan').innerHTML = '<i class="fas fa-times"></i>'
            document.getElementById('tutvideoSpan').style.color = "red"
         }         
         text = true;
         tuttype = 'mixed'
         fooContent();
      });
      writtenbutton.addEventListener('click', ()=>{
         kindCheck = true;
         file_div.style.display="none";
         written_div.style.display ="block";
         text = true;
         tuttype = 'written'
         fooContent();
      });
   }
   mainvideo.addEventListener('change', (e)=>{
      if(mainvideo.files.length != 0){
         mainvideoCheck = true
         document.getElementById('tutvideoSpan').innerHTML = '<i class="fas fa-check"></i>'
         document.getElementById('tutvideoSpan').style.color = "green"
      }else{
         mainvideoCheck = false
         document.getElementById('tutvideoSpan').innerHTML = '<i class="fas fa-times"></i>'
         document.getElementById('tutvideoSpan').style.color = "red"
      }
      validateForm();

   })
  
}
