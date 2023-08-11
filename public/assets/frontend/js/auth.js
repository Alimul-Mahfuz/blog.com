document.getElementById('password-reset-request-form').addEventListener('submit', async function (event) {
  event.preventDefault();
  const formData = new FormData(this);
  try {
    const response = await fetch('reset-request', {
      method: 'POST',
      body: formData,
      headers: {
        'X-CSRF-TOKEN': formData.get('_token'), // Alternatively, you can set the CSRF token in the headers
      },
    });
    const notify = document.getElementById('notify');
    notify.innerText=''
    const data = await response.json();
    if (!response.ok) {
      if (response.status === 422) {
        notify.classList.add('text-danger');
        let err = Object.values(data)[0];
        notify.innerText = err
      }
      else {
        throw new Error(`HTTP error! Status: ${response.status}`);
      }
    }
    if (data.hasOwnProperty('is_exists')) {
      if (!Object.values(data)[0]) {
        notify.classList.add('text-danger');
        notify.innerText = "Account doesn't exists"
      }
      else {
        notify.classList.remove('text-danger');
        notify.classList.add('text-success');
        notify.innerText = "A password reset link has been sent to your account!"
      }
    }
  } catch (error) {
    console.error('Error sending form data:', error);
  }
});
