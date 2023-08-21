const LiveSearch = (inputFildId, previewerId)=>{
    document.getElementById(inputFildId).addEventListener('keyup', async function (e) {
        const previewer = document.getElementById(previewerId);
        if (e.target.value === '') {
            previewer.innerHTML = ''
            previewer.classList.add('d-none')
        }
        else {
            previewer.classList.remove('d-none')
        }
        try {
            const url = `user-post/search/${encodeURIComponent(e.target.value)}`
            const response = await fetch(url)
            const data = await response.json();
            previewer.innerHTML = ''
            data.forEach(post => {
                const cardBody = document.createElement('div');
                cardBody.classList.add('card-body');
                cardBody.innerHTML = `<a href="read-blog/${post.id}">* ${post.title}</a>`;
                previewer.appendChild(cardBody)
            });
        } catch (error) {

        }
    })
}

