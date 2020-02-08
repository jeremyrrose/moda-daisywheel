const main = document.querySelector('main');
const container = document.querySelector('.container');
const burgerMenu = document.querySelector('.menuframe');
const mainMenu = document.querySelector('.menu');
const hamburger = document.querySelector('.hamburger');
const mainBurgerIcon = document.querySelector('.mainBurger');
const sideBurgerIcon = document.querySelector('.burgerButton');
const menuBurgerDiv = document.querySelector('.menuBurger');
const arrowIcon = document.querySelector('.arrow');
const menuItems = document.querySelector('.menuframe').querySelectorAll('a');
const logo = document.querySelector('.logo');
const logoClick = document.querySelector('.logoClick');
const mobileBurger = logo.querySelector('.mobileBurger');
const hero = document.querySelector('.hero');
const photos = document.querySelectorAll('.photo');
const morePhotos = document.querySelectorAll('.moreImage');
const grids = document.querySelectorAll('.grid');

// Randomize photos for demo purposes
// const uniqueRands = (min, max, quant) => {
//     let tempArr = [];
//     while (tempArr.length < quant) {
//         let num = Math.floor(Math.random() * max) + min;
//         if (!tempArr.includes(num)) {
//             tempArr.push(num);    
//         }        
//     }
//     return tempArr;
// }

// if (photos.length > 0) {
//     let photoNums = uniqueRands(1,9,photos.length);
//     photos.forEach((item) => item.style.backgroundImage = `url(images/${photoNums.pop()}.jpg)`);
// }

// if (morePhotos.length > 0) {
//     let morePhotoNums = uniqueRands(1,9,morePhotos.length);
//     morePhotos.forEach(item => item.style.backgroundImage = `url(images/${morePhotoNums.pop()}s.jpg)`);
// }

// if (hero) {         
//     let num = Math.floor(Math.random() * 9) + 1;
//     hero.style.backgroundImage = `url(images/${num}.jpg)`;
// }

// Create menu item animation
const opacitizer = (arr, initTimeout = 0, inc = 50) => {
    if (burgerMenu.classList[1]) {
        for (let i = 0; i < arr.length; i++) {
            setTimeout(() => arr[i].style.opacity = 1, initTimeout);
            initTimeout += inc;
        }
    }
}

// Toggle menu (differently depending on screen size)
const menuToggle = () => {
    if (window.matchMedia("(max-width: 900px)").matches) {
        if (!burgerMenu.classList[1]) {
            document.body.classList.add('noScroll');
            logo.classList.add('sticky');
            burgerMenu.addEventListener('transitionend',() => opacitizer(menuItems, 0, 40));
            burgerMenu.classList.add('open');
            mainMenu.classList.add('open');
        } else {            
            burgerMenu.classList.remove('open');
            mainMenu.classList.remove('open');
            document.body.classList.remove('noScroll');
            if (window.scrollY < stickyPoint) {
                window.scrollTo(0, stickyPoint);
            }
            menuItems.forEach(item => item.style.opacity = 0);
        }
    } else {
        if (!burgerMenu.classList[1]) {
            hamburger.style.opacity = 0;
            setTimeout(() => hamburger.style.width = "0px", 600);
            sideBurgerIcon.style.opacity = 1;
            burgerMenu.addEventListener('transitionend',() => opacitizer(menuItems, 0, 40));
            burgerMenu.classList.add('open');
            if (hero) { hero.classList.add('squooshed'); }
            main.classList.add('squooshed');
            container.classList.add('squooshed');
            grids.forEach(function(item) {
                item.classList.toggle('squooshed');
            })

        } else {
            sideBurgerIcon.style.opacity = 0;
            burgerMenu.classList.remove('open');
            main.classList.remove('squooshed');
            container.classList.remove('squooshed');
            if (hero) { hero.classList.remove('squooshed'); }
            hamburger.style.width = "80px";
            hamburger.style.opacity = 1;
            menuItems.forEach(item => item.style.opacity = 0);
            grids.forEach(function(item) {
                item.classList.toggle('squooshed');
            })
        }
    }
}

// Event listeners
logoClick.addEventListener('click', () => window.location.href = "index.php");

menuBurgerDiv.addEventListener('click', menuToggle);
menuBurgerDiv.addEventListener('mouseover',function () {
    sideBurgerIcon.setAttribute('src','images/hamburgerHover.svg');
    arrowIcon.setAttribute('src','images/arrowHover.svg');
});
menuBurgerDiv.addEventListener('mouseout',() => {
    sideBurgerIcon.setAttribute('src','images/hamburger.svg');
    arrowIcon.setAttribute('src','images/arrow.svg');
});

hamburger.addEventListener('click',menuToggle);
hamburger.addEventListener('mouseover',() => mainBurgerIcon.setAttribute('src','images/hamburgerHover.svg'));
hamburger.addEventListener('mouseout',() => mainBurgerIcon.setAttribute('src','images/hamburger.svg'));

mobileBurger.addEventListener('click',menuToggle);
mobileBurger.addEventListener('mouseover',() => mobileBurger.setAttribute('src','images/hamburgerHover.svg'));
mobileBurger.addEventListener('mouseout',() => mobileBurger.setAttribute('src','images/hamburger.svg'));

// Sticks hamburger at screen top on scroll in mobile / tablet
let stickyPoint = logo.offsetTop;
const stickinator = () => {
    if (window.matchMedia("(max-width: 900px)").matches) {
        if (window.pageYOffset >= stickyPoint) {
            logo.classList.add('sticky');
        } else {
            logo.classList.remove('sticky');
        }
    }
}
window.onscroll = stickinator;
