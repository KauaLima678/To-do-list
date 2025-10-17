const sidebar = document.getElementById('sidebar');
const closeBtn = document.querySelector('.close');
const textLink = document.querySelectorAll('.textLink a');
const openBtn = document.getElementById('open');
const username = document.querySelector('.username')
const navSide = document.querySelector('.asideNav')

function closeSide() {
     sidebar.style.width = '5%'
     sidebar.style.padding = '30px 24px'
     openBtn.style.opacity = 1
     username.style.display = "none"
     closeBtn.style.display = 'none'

     

     textLink.forEach(link => {
        link.style.display = 'none'
     });
}

function openSide() {
     sidebar.style.width = '20%'
     sidebar.style.padding = '30px'
     openBtn.style.opacity = 0
     openBtn.style.transition = '0s'
     username.style.display = "block"
     closeBtn.style.display = 'block'

     

     textLink.forEach(link => {
        link.style.display = 'flex'
     });
}