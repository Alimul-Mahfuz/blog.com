document.getElementById('password-reset-request-form').addEventListener('submit',function (event) {
  event.preventDefault();
  const formData = new FormData(this);
  console.log(Object.keys(formData))
});
