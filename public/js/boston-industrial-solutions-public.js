(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */


if (jQuery(window).width() > 1024) {
jQuery(window).scroll(function(){
  var sticky = jQuery('.sticky-header'),
	  scroll = jQuery(window).scrollTop();

  if (scroll >= 50) sticky.addClass('header-fixed');
  else sticky.removeClass('header-fixed');
});
}

if (jQuery(window).width() <= 1024) {
jQuery(window).scroll(function(){
  var sticky = jQuery('.sticky-header'),
	  scroll = jQuery(window).scrollTop();

  if (scroll >= 5) sticky.addClass('header-fixed');
  else sticky.removeClass('header-fixed');
});
}

jQuery(".headerserchicon").on("click", function() 
{
  jQuery('.newtogglesearchbox').addClass("show");
});

jQuery(".header_search_close_icon").on("click", function() 
{
  jQuery('.newtogglesearchbox').removeClass("show");
});

jQuery(".headerhelp").on("click", function() 
{
  jQuery('.togglephone').slideToggle();
});

})( jQuery );


/* menu */
const isTouchDevice = "ontouchstart" in window || navigator.maxTouchPoints > 0;

const navItems = document.querySelectorAll(".c360-nav__nav-items-list .c360-nav__nav-item");

navItems.forEach((item) => {
  item.addEventListener("click", function () {
    if (item.classList.contains("active-l1")) {
      item.classList.remove("active-l1");
    } else {
      navItems.forEach((otherItem) => {
        otherItem.classList.remove("active-l1");
      });
      item.classList.add("active-l1");
    }

    // Add event listeners for touch or mouse based on device
    if (isTouchDevice) {
      if (item.classList.contains("active-l1")) {
        item.addEventListener("touchstart", handleTouchStart);
        item.addEventListener("touchend", handleTouchEnd);
      } else {
        item.removeEventListener("touchstart", handleTouchStart);
        item.removeEventListener("touchend", handleTouchEnd);
      }
    } else {
      if (item.classList.contains("active-l1")) {
        item.addEventListener("mouseenter", handleMouseEnter);
        item.addEventListener("mouseleave", handleMouseLeave);
      } else {
        item.removeEventListener("mouseenter", handleMouseEnter);
        item.removeEventListener("mouseleave", handleMouseLeave);
      }
    }
  });
});

function handleMouseEnter() {
  const panelMessage = this.querySelector(".c360-nav__l2-panel-message");
  if (panelMessage) {
    panelMessage.classList.add("hide");
  }
}

function handleMouseLeave() {
  const panelMessage = this.querySelector(".c360-nav__l2-panel-message");
  if (panelMessage) {
   // panelMessage.classList.remove("hide");
  }
}

function handleTouchStart() {
  const panelMessage = this.querySelector(".c360-nav__l2-panel-message");
  if (panelMessage) {
    panelMessage.classList.add("hide");
  }
}

function handleTouchEnd() {
  const panelMessage = this.querySelector(".c360-nav__l2-panel-message");
  if (panelMessage) {
    //panelMessage.classList.remove("hide");
  }
}



const navItemss = document.querySelectorAll(".c360-nav__nav-item--l2");

navItemss.forEach((items, index) => {
  items.addEventListener("mouseenter", function () {
    // Add 'activeMenu' class to the current item
    items.classList.add("activeMenu");
    
    // Check if the element has a related `.c360-nav__l3-panel`
    const l3Panel = items.querySelector(".c360-nav__l3-panel");
    if (l3Panel) {
      l3Panel.classList.add("active");
    }
  });

  items.addEventListener("mouseleave", function () {
    // Remove 'activeMenu' class from the current item
    items.classList.remove("activeMenu");

    // Remove the 'active' class from all other `.c360-nav__l3-panel` elements except the current one
    navItemss.forEach((otherItem) => {
      if (otherItem !== items) {
        const otherL3Panel = otherItem.querySelector(".c360-nav__l3-panel");
        if (otherL3Panel) {
          otherL3Panel.classList.remove("active");
        }
      }
    });

    // Now remove the 'active' class from the current l3Panel
    const l3Panel = items.querySelector(".c360-nav__l3-panel");
    if (l3Panel) {
      l3Panel.classList.remove("active");
    }
  });
});


const sidebar = document.querySelector('.cartsidebar'); 
const openBtn = document.querySelector('.shoppingcart'); 
const closeBtn = document.querySelector('.closesidebar');
openBtn.addEventListener('click', () => {
  sidebar.classList.add('open');
});
closeBtn.addEventListener('click', () => {
  sidebar.classList.remove('open');
});
/* menu */

