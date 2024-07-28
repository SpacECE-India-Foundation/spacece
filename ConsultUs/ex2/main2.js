document.querySelector('#form').addEventListener('submit',e => {
    e.preventDefault();
    let form = document.querySelector('#form');
    const data = new URLSearchParams();
    for(const p of new FormData(form)){
        data.append(p[0],p[1]);
    }
    fetch('sever.php',{
        method: 'POST',
        body: data
    }).then(response => response.text()).then(response =>{
        document.querySelector('.msg').innerHTML=response;
    }).catch(error => console.log(error));
});