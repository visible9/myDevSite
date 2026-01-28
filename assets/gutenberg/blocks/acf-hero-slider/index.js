import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay, EffectFade } from 'swiper/modules';

const swiperConfig = {
  modules: [Navigation, Pagination, Autoplay, EffectFade],
  fadeEffect: { crossFade: true },
  loop: true,
  slidesPerView: 1,
  speed: 500,
  autoplay: { delay: 5000, disableOnInteraction: false },
  navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
  pagination: {
    el: '.swiper-pagination',
    type: 'bullets',
    clickable: true,
  },
};

document.querySelectorAll('.js-acf-hero-slider').forEach((wrapper) => {
  const el = wrapper.querySelector('.swiper');
  if (!el) return;

  if (el.swiper) el.swiper.destroy(true, true);

  const dataOptions = wrapper.dataset.swiperOptions
    ? JSON.parse(wrapper.dataset.swiperOptions)
    : {};

  const finalConfig = {
    ...swiperConfig,
    ...dataOptions,
  };

  if (dataOptions.autoplay === false) {
    delete finalConfig.autoplay;
    finalConfig.autoplay = false;
  } else {
    finalConfig.autoplay = {
      delay: 5000,
      disableOnInteraction: false,
      ...(typeof dataOptions.autoplay === 'object' ? dataOptions.autoplay : {}),
    };
  }

  new Swiper(el, finalConfig);
});
