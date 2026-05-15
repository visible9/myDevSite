// Import everything from autoload folder
import './autoload/*'; // eslint-disable-line

// Import local dependencies
import { scrollIntoViewWithOffset } from './utils/helpers';

// Import plugins
import 'jquery-match-height';
// import 'slick-carousel';
// import '@fancyapps/fancybox/dist/jquery.fancybox.min';
// import { jarallax, jarallaxElement } from 'jarallax';
// import ScrollOut from 'scroll-out';

// Import scripts from Custom ACF Gutenberg blocks
import '../gutenberg/blocks/**/index.js'; // eslint-disable-line

/**
 * Fit slide video background to video holder
 */
function resizeVideo() {
  let $holder = $('.videoHolder');
  $holder.each(function () {
    let $that = $(this);
    let ratio = $that.data('ratio') ? $that.data('ratio') : '16:9';
    let width = parseFloat(ratio.split(':')[0]);
    let height = parseFloat(ratio.split(':')[1]);
    $that.find('.video').each(function () {
      if ($that.width() / width > $that.height() / height) {
        $(this).css({
          width: '100%',
          height: 'auto',
        });
      } else {
        $(this).css({
          width: ($that.height() * width) / height,
          height: '100%',
        });
      }
    });
  });
}

/**
 * Set CSS variable for header height
 */
const setHeaderHeight = () => {
  const header = document.querySelector('.header');

  if (header) {
    setTimeout(() => {
      document.body.style.setProperty(
        '--header-height',
        `${header.offsetHeight}px`
      );
    }, 100);
  }
};

/**
 * Scripts which runs after DOM load
 */
$(document).on('ready', function () {
  // Mobile menu handler
  mobileMenuHandler();

  // Create CSS variable for header height
  setHeaderHeight();
  /**
   * Make elements equal height
   */
  $('.matchHeight').matchHeight();

  /**
   * Add fancybox to images
   */
  // $('.gallery-item')
  //   .find('a[href$="jpg"], a[href$="png"], a[href$="gif"]')
  //   .attr('rel', 'gallery')
  //   .attr('data-fancybox', 'gallery');
  // $(
  //   '.fancybox, a[rel*="album"], a[href$="jpg"], a[href$="png"], a[href$="gif"]'
  // ).fancybox({
  //   minHeight: 0,
  //   helpers: {
  //     overlay: {
  //       locked: false,
  //     },
  //   },
  // });

  /**
   * Init parallax
   */
  // jarallaxElement();
  // jarallax(document.querySelectorAll('.jarallax'), {
  //   speed: 0.5,
  // });

  /**
   * Detect element appearance in viewport
   */
  // ScrollOut({
  //   offset: function() {
  //     return window.innerHeight - 200;
  //   },
  //   once: true,
  //   onShown: function(element) {
  //     if ($(element).is('.ease-order')) {
  //       $(element)
  //         .find('.ease-order__item')
  //         .each(function(i) {
  //           let $this = $(this);
  //           $(this).attr('data-scroll', '');
  //           window.setTimeout(function() {
  //             $this.attr('data-scroll', 'in');
  //           }, 300 * i);
  //         });
  //     }
  //   },
  // });

  /**
   * Remove placeholder on click
   */
  const removeFieldPlaceholder = () => {
    $('input, textarea').each((i, el) => {
      $(el)
        .data('holder', $(el).attr('placeholder'))
        .on('focusin', () => {
          $(el).attr('placeholder', '');
        })
        .on('focusout', () => {
          $(el).attr('placeholder', $(el).data('holder'));
        });
    });
  };

  removeFieldPlaceholder();

  $(document).on('gform_post_render', () => {
    removeFieldPlaceholder();
  });

  /**
   * Scroll to Gravity Form confirmation message after form submit
   */
  $(document).on('gform_confirmation_loaded', function (_, formId) {
    let target = document.getElementById(
      `gform_confirmation_wrapper_${formId}`
    );

    if (target) {
      scrollIntoViewWithOffset(target, 100);
      return false;
    }
  });

  /**
   * Hide gravity forms required field message on data input
   */
  $('body').on(
    'change keyup',
    '.gfield input, .gfield textarea, .gfield select',
    function () {
      let $field = $(this).closest('.gfield');
      if ($field.hasClass('gfield_error') && $(this).val().length) {
        $field.find('.validation_message').hide();
      } else if ($field.hasClass('gfield_error') && !$(this).val().length) {
        $field.find('.validation_message').show();
      }
    }
  );

  resizeVideo();
});

/**
 * Mobile menu handler
 */
function mobileMenuHandler() {
  const $menu = $('#menu-header-menu');
  const $titleBar = $('.title-bar');
  const $menuButton = $('.menu-icon');
  const $body = $('body');

  if (!$menu.length || !$titleBar.length) return;

  function isMobileMenuActive() {
    return $titleBar.is(':visible');
  }

  function initMobileMenu() {
    if (!isMobileMenuActive()) return;

    $menu.find('.menu-item-has-children').each(function () {
      const $item = $(this);
      const $submenu = $item.children('.submenu');
      const $link = $item.children('a');

      if (!$submenu.length || $item.children('.submenu-toggle').length) return;

      $item.attr('aria-expanded', 'false');
      $submenu.hide();

      const $button = $(
        '<button class="submenu-toggle" aria-expanded="false"><span></span></button>'
      );
      $link.after($button);

      $button.on('click', function (e) {
        e.preventDefault();
        e.stopPropagation();

        const isOpen = $item.hasClass('is-open');
        const newState = !isOpen;

        $item.toggleClass('is-open');
        $item.attr('aria-expanded', newState);
        $button.attr('aria-expanded', newState);

        $submenu.stop(true, true).slideToggle(300);
      });
    });
  }

  function closeAllSubmenus() {
    $menu.find('.submenu').stop(true, true).slideUp(0);
    $menu
      .find('.menu-item-has-children')
      .removeClass('is-open')
      .attr('aria-expanded', 'false');
    $menu.find('.submenu-toggle').attr('aria-expanded', 'false');
  }

  function destroyMobileMenu() {
    closeAllSubmenus();
    $menu.find('.submenu').removeAttr('style').show();
    $menu.find('.submenu-toggle').remove();
    $menu.find('.menu-item-has-children').removeAttr('aria-expanded');
  }

  function checkMenuState() {
    if (isMobileMenuActive()) {
      initMobileMenu();
    } else {
      destroyMobileMenu();
    }
  }

  $menuButton.on('click', function () {
    const isOpen = $(this).hasClass('is-active');

    if (isOpen) {
      $body.css('overflow', 'hidden');
    } else {
      $body.css('overflow', '');
      closeAllSubmenus();
    }
  });

  checkMenuState();

  $(window).on('resize', checkMenuState);
}

/**
 * Scripts which runs after all elements load
 */
$(window).on('load', function () {
  // Preloader
  let $preloader = $('.preloader');
  if ($preloader.length) {
    $preloader.addClass('preloader--hidden');
  }
});

/**
 * Scripts which runs at window resize
 */
$(window).on('resize', function () {
  // jQuery code goes here
  resizeVideo();

  // Create CSS variable for header height
  setHeaderHeight();
});

/**
 * Scripts which runs on scrolling
 */
$(window).on('scroll', function () {
  // jQuery code goes here
});
