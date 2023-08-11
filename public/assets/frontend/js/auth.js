document.getElementById('password-reset-request-form').addEventListener('submit', async function(event) {
    event.preventDefault();
    const formData = new FormData(this);
    formData.append('_token', '{{ csrf_token() }}'); // This gets replaced by Laravel with the actual token value
    try {
      const response = await fetch('reset-request', {
        method: 'POST',
        body: formData,
        headers: {
          'Content-Type':'json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}', // Alternatively, you can set the CSRF token in the headers
        },
      });
  
      if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
      }
  
      const data = await response.json();
      console.log('Response from server:', data);
    } catch (error) {
      console.error('Error sending form data:', error);
    }
  });
  