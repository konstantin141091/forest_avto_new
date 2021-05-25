$(document).ready(function(){

    ymaps.ready(init);
  
    function init() {

      let points = [];

      let pointers = [];

      try{

        const centerMap = [52.03067107205304,113.49252399999997];
        const zoomMap = $(window).innerWidth()<1200?13:14;

        let map;

        if ($('#contacts-map').length>0){
          map = new ymaps.Map("contacts-map", {
            center: centerMap,
            controls: [],
            zoom: zoomMap
          });
        }
        else if ($('#order-map').length>0){
          map = new ymaps.Map("order-map", {
            center: centerMap,
            controls: [],
            zoom: zoomMap
          });
        }
        
        map.panes.get('ground').getElement().style.filter = 'grayscale(100%)';
        
        // Создание точек
        $('.order-contact').each(function(index, item){
          let pointer = createPoint(item);
          map.geoObjects.add(pointer);
        });

        // Активация точки по клику в контактах
        $('.contacts-list__item').click(function(){
          const addrId = $(this).data('addrId');
          setActivePoint(addrId);
        });

        // Активация точки по выбору в selectе
        $('select.pick-point').change(function(e){
          const option = $(this).children(`option[value="${$(this).val()}"]`);
          if (option.val()!='Не выбрано'){
            const addrId = option.data('addrId');
            setActivePoint(addrId);           
          }
          else{
            resetPoints();
          }
        
        });

        // Прокрутка до карты в контактах
        $("body").on('click', '.contacts-list__item', function(e){
            if ($(window).width()<1200){
                const offsetTop =  $('#contacts-map').offset().top;
                const fixedOffset = 200;
                $('html,body').stop().animate({ scrollTop: offsetTop - fixedOffset }, 1000);
                e.preventDefault();
                return false;            
            }

        });

      } catch(e){}

      // Cоздание точки и указателя из data-атрибутв DOM-элемента
      // Возвращает объект Placemark
      function createPoint(item){
          let point = {
              id:$(item).data('addrId'),
              coords:$(item).data('coords').split(','),
          };
          points.push(point);
          
          let pointer =  new ymaps.Placemark(point.coords, {
              balloonContent: ``,
              addrId:point.id,
              addrCoords:point.coords
            }, {
              iconLayout: 'default#image',
              iconImageHref: 'img/map-pointer.svg',
              iconImageSize: [60, 70],
              iconImageOffset: [-30, -70]
            });
            
          pointers.push(pointer);
          
          return pointer;
      }

      // Возвращает указатель по его id
      function getPointerById(id){
        const pointer = pointers.filter(item=>{
             return item.properties.get('addrId')==id;
        }).pop();
         
        return pointer;
      }

      // Меняет иконку указателя и устанавливает его по центру карты
      function setActivePoint(id){
          resetPoints();

          const pointer = getPointerById(id);

          pointer.options.set({
            iconImageHref: 'img/map-pointer-active.svg',
            iconImageSize: [60, 70],
          });

          map.setCenter(pointer.properties.get('addrCoords'));
      }

      // Сброс всех активных указателей
      function resetPoints(){
        pointers.map(item=>{
          item.options.set({
              iconImageHref: 'img/map-pointer.svg',
              iconImageSize: [60, 70],
          });
        })
      }        

    }
  
  });
  