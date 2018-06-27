var input = document.querySelector('#headerColor');

if (input) {
    var nav = document.querySelector('nav');
    input.addEventListener('change', ()=>{
        nav.style.backgroundColor = input.value;
    })
}