document.getElementById('profile_image').addEventListener('change', function () {
  let savebtn = document.getElementById('btn-image-save');
  savebtn.classList.remove('d-none');
})
document.getElementById('profie-img-upload').addEventListener('submit', async function (e) {
  e.preventDefault();
  let formdata = new FormData(this);
  try {
    const response = await fetch('profile_image/upload', {
      method: 'post',
      body: formdata,
      headers: {
        'X-CSRF-TOKEN': formdata.get('_token'),
      }
    });
    let data = await response.json();
    let errordiv = document.createElement('div');
    errordiv.innerText = '';
    if (!response.ok) {
      if (response.status == 422) {
        errordiv.classList.add('text', 'text-danger');
        let parent = document.querySelector('#profie-img-upload');
        errordiv.innerText = Object.values(data)[0];
        parent.insertAdjacentElement('afterend', errordiv)
      }
    }
    else {
      if (data['image_url'] != '') {
        document.getElementById('profile-image').src = 'storage/' + data['image_url']
        document.getElementById('btn-image-save').classList.add('d-none');
      }

    }
    // console.log(data['image_url'])

  } catch (error) {

  }
})

document.getElementById('personal-details-form').addEventListener('submit',async function(e){
  e.preventDefault();
  let formdata=new FormData(this);
  try {
    let response=await fetch('/profile-basic/update',{
      method:'post',
      body:formdata,
      headers:{
        'X-CSRF-TOKEN':formdata.get('_token')
      }
    })
    const status=document.getElementById('basic-info-status');
    status.innerHTML=''
    const data=await response.json();
    if(!response.ok){
      if(response.status==422){
        let perviousError=document.querySelectorAll('.personal-update-error')
        perviousError.forEach((errofield)=>{
          errofield.textContent=''
        })
        Object.entries(data).forEach(([k,v])=>{
          let parent=document.getElementById(k).parentNode;
          let errdiv=document.createElement('div')
          errdiv.classList.add('text-danger','personal-update-error');
          errdiv.innerText=v;
          parent.appendChild(errdiv);
        })

      }
    }
    if(data.success){
      status.classList.add('text-success');
      status.innerHTML=`<strong>${data.message}</strong>`;
    }
    
  } catch (error) {
    
  }
})

document.getElementById('password-update').addEventListener('submit',async function(e){
  e.preventDefault()
  let formdata=new FormData(this)
  try {
    const response=await fetch('password-update',{
      method:'POST',
      body:formdata,
      headers:{
        'X-CSRF-TOKEN':formdata.get('_token'),
      }
    })
    const data=await response.json();
    const status=document.getElementById('password-info-status');
    status.innerHTML=''
    if(!response.ok){
      if(response.status==422){
        let perviousError=document.querySelectorAll('.password-update-error')
        perviousError.forEach((errofield)=>{
          errofield.textContent=''
        })
        Object.entries(data).forEach(([k,v])=>{
          let parent=document.getElementById(k).parentNode;
          let errdiv=document.createElement('div')
          errdiv.classList.add('text-danger','password-update-error');
          errdiv.innerText=v;
          parent.appendChild(errdiv);
        })

      }
    }
    if(data.success){
      status.classList.add('text-success');
      status.innerHTML=`<strong>${data.message}</strong>`;
    }
  } catch (error) {
    
  }
})