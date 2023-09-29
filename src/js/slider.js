import Swiper from 'swiper';
import {Navigation} from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';

document.addEventListener('DOMContentLoaded',function(){
    if(document.querySelector('.slider')){
        const opciones = {
            modules: [Navigation],
            slidesPerView: 1,
            spaceBetween: 15,
            freeMode: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev'
            },
            breakpoints:{
                768: {
                    slidesPerView: 1
                },
                1024: {
                    slidesPerView: 2
                },
                1200: {
                    slidesPerView: 3
                }
            }
        }
        //Swiper.use([Navigation]);
        new Swiper('.slider',opciones);
    }
});