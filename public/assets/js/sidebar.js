const sidebar = document.getElementById('sidebar');
const closeBtn = document.querySelector('.close');
const textLink = document.querySelectorAll('.textLink');
const openBtn = document.getElementById('open');
const username = document.querySelector('.username');
const navSide = document.querySelector('.asideNav');
const iconLogout = document.getElementById('iconLogout');
const textLogout = document.querySelector('.textLogout')

function closeSide() {
     sidebar.style.width = '5%'
     sidebar.style.padding = '30px 24px'
     openBtn.style.opacity = 1
     username.style.display = "none"
     closeBtn.style.display = 'none'
     textLogout.style.display = 'none'
     iconLogout.style.fontSize = '30px'

     

     textLink.forEach(link => {
        link.style.display = 'none'
     });
}

function openSide() {
     sidebar.style.width = '20%'
     sidebar.style.padding = '30px'
     openBtn.style.opacity = 0
     username.style.display = "block"
     closeBtn.style.display = 'block'
     textLogout.style.display = 'block'
     iconLogout.style.fontSize = '16px'

     

     textLink.forEach(link => {
        link.style.display = 'flex'
     });
}