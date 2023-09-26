function init() {
    const slide = document.querySelector('.slide');
    const slideContent = slide.querySelector('.slide__content');
    const slideNavigation = slide.querySelector('.slide__navigation');
    const links = slideNavigation.querySelectorAll('.slide__navigation_link');
    const images = slideContent.querySelectorAll('.slide__image img');
    let isChanged = true;
    let index = 0;

    slideContent.addEventListener('mouseenter', () => disableScroll())
    slideContent.addEventListener('mouseleave', () => enableScroll())
    if (slideContent.addEventListener) {
        slideContent.addEventListener("mousewheel", MouseWheelHandler, false);
        slideContent.addEventListener("DOMMouseScroll", MouseWheelHandler, false);
    }

    function MouseWheelHandler(e) {
        let delta = Math.max(-1, Math.min(1, (e.wheelDelta || -e.detail)));
        if (isChanged){
            if (delta > 0){
                prev()
            }
            else{
                next()
            }
            isChanged = false
        }


    }

    function next() {
        console.log(index)
        if (index < 4){
            index  += 1
        }else{
            enableScroll()
        }
        render()
    }

    function prev() {
        if (index > 0) {
            index  -= 1
        }else{
            enableScroll()
        }
        render()
    }
    function render(){
        links.forEach((link, i) => {
            link.classList.remove('slide__navigation_link-active')
            images[i].classList.remove('slide__image-active')
            if (links[index]){
                links[index].classList.add('slide__navigation_link-active')
                images[index].classList.add('slide__image-active')
            }
        })
        setTimeout(() => {
            isChanged = true
        }, 1000)
    }
}

init()

// left: 37, up: 38, right: 39, down: 40,
// spacebar: 32, pageup: 33, pagedown: 34, end: 35, home: 36
let keys = {37: 1, 38: 1, 39: 1, 40: 1};

function preventDefault(e) {
    e.preventDefault();
}

function preventDefaultForScrollKeys(e) {
    if (keys[e.keyCode]) {
        preventDefault(e);
        return false;
    }
}

// modern Chrome requires { passive: false } when adding event
let supportsPassive = false;
try {
    window.addEventListener("test", null, Object.defineProperty({}, 'passive', {
        get: function () {
            supportsPassive = true;
        }
    }));
} catch (e) {
}

let wheelOpt = supportsPassive ? {passive: false} : false;
let wheelEvent = 'onwheel' in document.createElement('div') ? 'wheel' : 'mousewheel';

// call this to Disable
function disableScroll() {
    window.addEventListener('DOMMouseScroll', preventDefault, false); // older FF
    window.addEventListener(wheelEvent, preventDefault, wheelOpt); // modern desktop
    window.addEventListener('touchmove', preventDefault, wheelOpt); // mobile
    window.addEventListener('keydown', preventDefaultForScrollKeys, false);
}

// call this to Enable
function enableScroll() {
    window.removeEventListener('DOMMouseScroll', preventDefault, false);
    window.removeEventListener(wheelEvent, preventDefault, wheelOpt);
    window.removeEventListener('touchmove', preventDefault, wheelOpt);
    window.removeEventListener('keydown', preventDefaultForScrollKeys, false);
}
