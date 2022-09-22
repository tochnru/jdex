new Swiper('.event-slider',{
   //Стрелки
   navigation:{
      nextEl: ".swiper-button-next",//Стандартные классы, стили стрелок и их местоположение можно расположить где угодно
      prevEl: ".swiper-button-prev"
   },
   //Навигация
   pagination:{
      el: ".swiper-pagination",
      clickable: true,
      dynamicBullets: true, //Динамические буллеты
      //Фракция
      type: "fraction",
   },
});
