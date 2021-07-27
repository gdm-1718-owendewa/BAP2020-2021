if(document.getElementById('article-create-div') != null){
    function validateForm(){
        if(titleCheck && contentCheck && bannerCheck){
            button.disabled = false
            button.style.backgroundColor= ""
        }else{
            button.disabled = true
            button.style.backgroundColor= "grey"
        }
    }
    let button = document.querySelector('#submit')
    button.disabled = true
    button.style.backgroundColor= "grey"
    let titleCheck = false;
    document.getElementById('titleSpan').innerHTML = '<i class="fas fa-times"></i>'
    document.getElementById('titleSpan').style.color = "red"
    let title = document.getElementById('title');
    title.addEventListener('input', (e) => {
        if(title.value.length > 0 && title.value.length < 200){
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
    let content = document.getElementById('inhoud');
    let contentCheck = false;
    function foo() {
        let contentLength = content.getAttribute('data-length');
        if(contentLength <= 299 ){
            contentCheck = false;
            document.getElementById('contentSpan').innerHTML = '<i class="fas fa-times"></i>'
            document.getElementById('contentSpan').style.color = "red"
            setTimeout(foo, 2000);
        }
        else if(contentLength > 299){
            contentCheck = true;
            document.getElementById('contentSpan').innerHTML = '<i class="fas fa-check"></i>'
            document.getElementById('contentSpan').style.color = "green"
            setTimeout(foo, 2000);
        }
        validateForm();
    }
    foo();
    let bannerCheck = false;
    document.getElementById('bannerSpan').innerHTML = '<i class="fas fa-times"></i>'
    document.getElementById('bannerSpan').style.color = "red"
    let bannerImage = document.getElementById('banner-image');
    bannerImage.addEventListener('change', (e)=>{
        if(bannerImage.files.length != 0){
            bannerCheck = true
            document.getElementById('bannerSpan').innerHTML = '<i class="fas fa-check"></i>'
            document.getElementById('bannerSpan').style.color = "green"
        }else{
            bannerCheck = false
            document.getElementById('bannerSpan').innerHTML = '<i class="fas fa-times"></i>'
            document.getElementById('bannerSpan').style.color = "red"
        }
        validateForm();
    })
}
if(document.getElementById('article-edit-div') != null){
    let button = document.querySelector('#submit')
    function validateForm(){
        if(titleCheck && contentCheck && bannerCheck){
            button.disabled = false
            button.style.backgroundColor= ""
        }else{
            button.disabled = true
            button.style.backgroundColor= "grey"
        }
    }
    let title = document.getElementById('title');
    let titleCheck = true;
    let bannerImage = document.getElementById('banner-image');
    let bannerCheck = true;
    let content = document.getElementById('inhoud');
    let contentCheck = true;
    document.getElementById('titleSpan').innerHTML = '<i class="fas fa-check"></i>'
    document.getElementById('titleSpan').style.color = "green"
    document.getElementById('contentSpan').innerHTML = '<i class="fas fa-check"></i>'
    document.getElementById('contentSpan').style.color = "green"
    document.getElementById('bannerSpan').innerHTML = '<i class="fas fa-check"></i>'
    document.getElementById('bannerSpan').style.color = "green"
    title.addEventListener('input', (e) => {
        if(title.value.length > 0 && title.value.length < 200){
            titleCheck = true;
            document.getElementById('titleSpan').innerHTML = '<i class="fas fa-check"></i>'
            document.getElementById('titleSpan').style.color = "green"

        }else{
            titleCheck = false;
            document.getElementById('titleSpan').innerHTML = '<i class="fas fa-times"></i>'
            document.getElementById('titleSpan').style.color = "red"
        }
        validateForm()
    })
    bannerImage.addEventListener('change', (e)=>{
        if(bannerImage.files.length != 0){
            bannerCheck = true
            document.getElementById('bannerSpan').innerHTML = '<i class="fas fa-check"></i>'
            document.getElementById('bannerSpan').style.color = "green"
        }else{
            bannerCheck = false
            document.getElementById('bannerSpan').innerHTML = '<i class="fas fa-times"></i>'
            document.getElementById('bannerSpan').style.color = "red"
        }
        validateForm()
    })
    function foo() {
        let contentLength = content.getAttribute('data-length');
        if(contentLength <= 299 ){
            contentCheck = false;
            document.getElementById('contentSpan').innerHTML = '<i class="fas fa-times"></i>'
            document.getElementById('contentSpan').style.color = "red"
            setTimeout(foo, 2000);
        }
        else if(contentLength > 299){
            contentCheck = true;
            document.getElementById('contentSpan').innerHTML = '<i class="fas fa-check"></i>'
            document.getElementById('contentSpan').style.color = "green"
            setTimeout(foo, 2000);
        }
        validateForm();
    }
    foo();
}