$(document).ready(function(){
       
  // datetime picker
  $(".datetimepicker").datetimepicker({
    lang:'cz',
    format:'Y-m-d H:i'
  });
  
  // rolovani informaci profilu v hlavicce
  $( "a#hinfo" ).click(function() {
    $( "tr.hinfo" ).toggle();
  });  
  
  // skryti flash message po kliknuti
  $( "div.flash" ).click(function() {
    $( this ).slideUp("slow");
  });

  // rozsireni admin menu boxu po najeti mysi (kvuli zobrazni dalsich polozek menu)
  var self = $( '.box-admin-menu' );
  $( self ).on('mouseenter', '.adminmenu', function(){ // pri najeti na menu
    $( self ).animate({
    	height: "120px"
  	}, 500, function() {
    	// Animation complete.
  	}); 
  }); 

  $( self ).on('mouseleave', function(){ // pri opusteni menu (cely box)
    $( self ).animate({
    	height: "54px"
  	}, 500, function() {
    	// Animation complete.
  	});
  }); 
  
  // js pro obsluhu fotogalerie 
  $( ".miniatures" ).on('click', 'img', function() {
    $( ".main-photo" ).children( "img" ).attr('src', $( this ).attr('src')); // po kliknutim na miniaturu, ji zobraz v hlavnim okne galerie
    $( ".main-photo" ).attr('photo-id', $( this ).parent( 'span' ).attr('photo-id')); // predam si idecko kliknute miniatury
  }); 

  // rozjizdeni popisku v main foto
  $( 'div.main-photo' ).hover(function(){
    $( this ).find( 'span' ).toggle( 'slide' );
    }, function(){
    $( this ).find( 'span' ).toggle( 'slide' );
  });
  
  // hezci mazani fotek
  $('table#photos_delete').on('click','tr.required', function() { // po kliknuti zjisti
      if($(this).hasClass('active')) { // zda-li bylo dane tr aktivni
        $(this).removeClass('active'); // tak ho deaktivuj
        $(this).find('img').css('display', 'none'); // a schovej obrazek, ktery znacil, ze byl tr aktivni (zelena fajfka)
        $(this).find('input[type="checkbox"]').prop('checked', false); // odoznac ho v checkboxu
      } else { // zda-li bylo dane tr neaktivni             
        $(this).addClass('active'); // tak ho aktivuj
        $(this).find('img').css('display', 'inline-block'); // oznac ho fajfkou, aby user videl, ze je aktivni
        $(this).find('input[type="checkbox"]').prop('checked', true); // oznac ho v checkboxu
      }
    }); 

    // hezci vyber hlavniho fota 
    $('table#photos_setmainphoto').on('click','tr.required', function() { 
        // projdi vsechny tr a schovej oznaceni
        $.each($('table#photos_setmainphoto tr.required'), function() {
          $(this).removeClass('active'); // tak ho deaktivuj
          $(this).find('img').css('display', 'none'); // a schovej obrazek, ktery znacil, ze byl tr aktivni (zelena fajfka)
          $(this).find('input[type="checkbox"]').prop('checked', false); // odoznac ho v checkboxu
        });
        // nove oznac prave kliknuty tr
        $(this).find('img').css('display', 'inline-block'); // oznac miniaturu fajfkou, aby user videl, ze je aktivni
        $(this).find('input[type="checkbox"]').prop('checked', true); // oznac ho v checkboxu    
    }); 

    // presmerovani z vypisu nemovitosti na detail nemovitosti
    $('div.boxes').on('click','div.detail', function() {
      window.location.href = '../detail-nemovitosti/' + $( this ).attr('idn');
    });  

    // presmerovani z defaultu na detail nemovitosti
    $('div.def-boxes').on('click','div.detail', function() {
      window.location.href = 'nemovitosti/detail-nemovitosti/' + $( this ).attr('idn');
    }); 

    // presmerovani z vyhledavani na detail nemovitosti
    $('div.search-boxes').on('click','div.detail', function() {
      window.location.href = '../../nemovitosti/detail-nemovitosti/' + $( this ).attr('idn');
    }); 

        // presmerovani z vyhledavani na detail nemovitosti
    $('div.search-basic-boxes').on('click','div.detail', function() {
      window.location.href = '../nemovitosti/detail-nemovitosti/' + $( this ).attr('idn');
    }); 

    // formatovani cisla (oddelovac tisicu)
    function format(num){
      var n = num.toString(), p = n.indexOf('.');
      return n.replace(/\d(?=(?:\d{3})+(?:\.|$))/g, function($0, i) {
        return p<0 || i<p ? ($0+',') : $0;
      });
    }

    // prihoz, navysovanim psanim cisel do inputu
    $( "input.castka" ).keyup(function() {
      var prihoz = parseInt($( this ).val()); // vezmu hodnotu prihazovane castky z inputu 
      var castka = parseInt($( "span#money" ).attr('money')); // vezmu aktualni hodnotu, ulozeou v html atributu money
      vysledek = castka + prihoz; // zjistim vysledek
      if(isNaN(vysledek)) // pokud neziskam vysledek (hazi NaN pokud v inputu nemam nactene nejake cislo)
      {
        $( "span#money" ).text('0'); // nedokazu zjisti vysledek, pak vypis 0
      } else {
        $( "span#money" ).text(format(vysledek)); // vim vysledek, pak ho tedy vypis
      }
    }).keyup();

    // prihoz, navysovanim pomoci kliku na sipky inputu (analogicke jako fce vyse, akorat pro klik)
    $( "form#frm-prihozForm" ).on("click", "input.castka", function() {
      var prihoz = parseInt($( this ).val());
      var castka = parseInt($( "span#money" ).attr('money'));
      vysledek = castka + prihoz;
      if(isNaN(vysledek))
      {
        $( "span#money" ).text('0');
      } else {
        $( "span#money" ).text(format(vysledek));
      }
    });
  
});                   