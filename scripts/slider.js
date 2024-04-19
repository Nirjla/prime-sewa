var swiper = new Swiper(".ps__custom--wrapper", {
      slidesPerView: 1,
      spaceBetween: 10,
      autoplay: {
            delay: 2500,
            disableOnInteraction: false,
          },
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
          },
      breakpoints: {
        640: {
          slidesPerView: 1,
          spaceBetween: 20,
        },
        768: {
          slidesPerView: 2,
          spaceBetween: 40,
        },
        1024: {
          slidesPerView: 3,
          spaceBetween: 50,
        },
      },
    });