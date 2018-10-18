(function( $ ) {
    wp.customize.bind( 'ready', function() {
        var customizer = this;

        singleSections = wp.customize.panel( 'singles' ).sections();
        archiveSections = wp.customize.panel( 'archives' ).sections();




       for ( i=0; i < singleSections.length; i++ ) {
         //banner image uploader
         contextualFields( singleSections[i].controls()[0].id, singleSections[i].controls()[1].id, 'custom-banner', true );
         contextualFields( archiveSections[i].controls()[0].id, archiveSections[i].controls()[1].id, 'custom-banner', true );

         contextualFields( singleSections[i].controls()[0].id, singleSections[i].controls()[2].id, 'no-banner', false);
       }


       function contextualFields( bannerType, customBanner, activeValue, state) {
         wp.customize( bannerType, function( value ) {


           if (state) {
             // skaffa värdet när sidan laddas, ifall fel värde: slideUp
             if ( value.get() !== activeValue ) {
               customizer.control(customBanner).container.slideUp( 180 );

             }

             // bind till ändringar i value, slidedown ifall custom banner
             value.bind( function( val ) {
               if ( val === activeValue ) {
                 customizer.control(customBanner).container.slideDown( 180 );
               }
               else {
                 customizer.control(customBanner).container.slideUp( 180 );
               }
             } );
           }

           else {

             if ( value.get() === activeValue ) {
               customizer.control(customBanner).container.slideUp( 180 );

             }

             // bind till ändringar i value, slidedown ifall custom banner
             value.bind( function( val ) {
               if ( val !== activeValue ) {
                 customizer.control(customBanner).container.slideDown( 180 );
               }
               else {
                 customizer.control(customBanner).container.slideUp( 180 );
               }
             } );
           }
         })
       }



    } );
})( jQuery );
