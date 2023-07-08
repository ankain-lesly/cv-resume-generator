let dropBtn = document.querySelectorAll('.drop-menu')

dropBtn.forEach(btn => {
    btn.addEventListener('click', (e) => {
        e.target.classList.toggle('active')
    })
})

let closeNavBtn = document.querySelector('.close-nav')
let openNavBtn = document.querySelector('.open-menu')
let navMenu = document.querySelector('.nav-menu')
closeNavBtn.onclick = function () {
    navMenu.classList.remove('active')
}
openNavBtn.onclick = function () {
    navMenu.classList.add('active')
}

let searchBtn = document.querySelector('.search-btn')
searchBtn.addEventListener('click', e => {
    let searchItem = prompt('Search Something')
    let popup = `<div class="box">
    <div class="head">
        <img src="images/icon.png">
        <button>&times;</button>
    </div>
    <div class="content">
        <h3>Search Results</h3>
        <p>Your search result from Bamenda Regional Hopital topic "<a href="index.html">${searchItem}</a>" is...</p>
    </div>`
    let box = document.createElement('div')
    box.innerHTML = popup
    box.classList.add('toastMe')

    let toast = document.querySelector('.toast')
    toast.appendChild(box)

    box.querySelector('button').onclick = () => {
        box.style.display = 'none'
    }
})