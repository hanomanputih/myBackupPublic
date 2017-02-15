/*
Message box.

[Description]
A simple modal "MessageBox" class built with jQuery. A message box displays a
modal message to the user. The message box can display busy, confirm, error, 
information, and warning messages by default, custom message types can also be
easily defined.    

[Version]
1.0

[Dependencies]
jquery.js (v1.2.6) {http://jquery.com}
jquery.dimensions.js (v1.2) {http://plugins.jquery.com/project/dimensions}

[Author]
Anthony Blackshaw <ant@getme.co.uk> (www.getme.co.uk)
Copyright (c)2008
*/


function MessageBox( on_init ) {
    
    /*
    The "MessageBox" class.
    */
    
    var message_box = this;
    
    this.visible = null;
    
    // Callback functions
    this.on_init = on_init;
    
    // To set the interface up we load some HTML from a file, then call
    // "init_interface" to bind all events.
    
    // Setup a division to load the interface elements into
    $( "body" ).append( '<div id="message-box"><div id="message-box-curtain"></div><div id="message-box-shadow"></div><div id="message-box-stage"></div><div id="default-message-box-types"><div id="busy-message-box"><div class="message-box-icon"><img src="/images/gfx/message-box-busy.png" alt="Busy"/></div><div class="message-box-title"></div><div class="message-box-message"></div></div><div id="confirm-message-box"><div class="message-box-icon"><img src="/images/gfx/message-box-confirm.png" alt="Confirm"/></div><div class="message-box-title"></div><div class="message-box-message"></div><div class="message-box-button-holder" style="width:126px;"><div class="message-box-button yes">Yes</div><div class="message-box-button no" style="margin-right:0;">No</div></div> </div><div id="error-message-box"><div class="message-box-icon"><img src="/images/gfx/message-box-error.png" alt="Error"/></div><div class="message-box-title"></div><div class="message-box-message"></div><div class="message-box-button-holder" style="width:58px;"><div class="message-box-button ok" style="margin-right:0;">OK</div></div></div><div id="information-message-box"><div class="message-box-icon"><img src="/images/gfx/message-box-information.png" alt="Information"/></div><div class="message-box-title"></div><div class="message-box-message"></div> <div class="message-box-button-holder" style="width:58px;"><div class="message-box-button ok" style="margin-right:0;">OK</div></div></div><div id="warning-message-box"><div class="message-box-icon"><img src="/images/gfx/message-box-warning.png" alt="Warning"/></div><div class="message-box-title"></div><div class="message-box-message"></div><div class="message-box-button-holder" style="width:58px;"><div class="message-box-button ok" style="margin-right:0;">OK</div></div></div></div></div>');
    message_box._init_interface(); 
}

MessageBox.prototype._init_interface = function() {

    /*
    Initialise the various interface elements.
    */

    var message_box = this;
    
    // Make sure the message box is hidden
    this.hide();
    
    if ( this.on_init ) {
        this.on_init( this );
    }
};


MessageBox.prototype._set_visible = function( visible ) {

    /* 
    Set the visibility of the message box.
    */
    
    var message_box = this;
    
    // Only act if visibility has changed 
    if ( this.visible != visible ) {
        
        // Update the message box's visibility
        if ( visible ) {
            
            // Show the message box
            this.visible = true;
            
            // Ensure the parent division is visible
            $( "#message-box" ).css( "display", "block" );
            
            // Curtain
            $( "#message-box-curtain" ).css( { "display" : "block", 
                "height" : $( document ).height()
                } );
                
            // IE fix for curtains width (100% is not calculated correctly during 
            // size transitions).
            if ( jQuery.browser.msie ) {
                $( "#message-box-curtain" ).css( "width", $( window ).width() );
            }
            
            // Determine the height of the message box stage
            $( "#message-box-stage" ).css( "display", "block" );
            var stage_height = $( "#message-box-stage" ).outerHeight( { "margin" : true } );
            var stage_width = $( "#message-box-stage" ).outerWidth( { "margin" : true } );
            var stage_x = ( $( window ).width() - stage_width ) / 2;
            var stage_y = ( $( window ).height() - stage_height ) / 2 + $( window ).scrollTop();
            $( "#message-box-stage" ).css( "display", "none" );
            
            // Position and size the message box stage and shadow
            $( "#message-box-stage" ).css( { "top" : stage_y, "left" : stage_x } );
            $( "#message-box-shadow" ).css( { "top" : stage_y, "left" : stage_x, "height" : stage_height } );
            
            // Show the message box stage and shadow
            $( "#message-box-stage" ).css( "display", "block" );
            $( "#message-box-shadow" ).css( "display", "block" );
            
        } else {
        
            // Hide the message box        
            $( "#message-box-curtain" ).css( "display", "none" );
            $( "#message-box-stage" ).css( "display", "none" );
            $( "#message-box-shadow" ).css( "display", "none" );
    
            message_box.visible = false;
        }
    }
};

MessageBox.prototype.hide = function() {

    /*
    Hide the message box
    */
    
    this._set_visible( false );
};

MessageBox.prototype.show = function( html, title, message ) {

    /*
    Show a message box
    */

    // Change the contents of the message box
    $( "#message-box-stage" ).html( html );
    $( "#message-box-stage .message-box-title" ).html( title );
    $( "#message-box-stage .message-box-message" ).html( message );

    this._set_visible( true );
    
    // IE 6 support for the icon image
    var icon_image = $( "#message-box-stage .message-box-icon img" );
    
    if ( jQuery.browser.msie && jQuery.browser.version == "6.0" ) {
        icon_image.css( { 
            "filter" : "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + icon_image.attr( "src" ) + "')",
            "height" : icon_image.height(),
            "width" : icon_image.width()
            } );
        icon_image.attr( "src", "/images/gfx/empty.gif" );
    }      
};

MessageBox.prototype.show_busy = function( title, message ) {

    /*
    Show a busy message box.
    */

    // Show the message
    this.show( $( "#busy-message-box" ).html(), 
        title, 
        message 
        );
};

MessageBox.prototype.show_confirm = function( title, message, on_yes, on_no, data ) {

    /*
    Show a confirm message box.
    */
    
    // Show the message
    this.show( $( "#confirm-message-box" ).html(), 
        title, 
        message
        );
        
    // Bind the function(s) to button(s)
    $( "#message-box-stage .yes" ).unbind( "click" );
    $( "#message-box-stage .yes" ).bind( "click", 
        { "message-box" : this }, 
        function( ev ) {
            ev.data[ "message-box" ].hide();
            if ( on_yes ) {
                on_yes.call( this, data );
            }
        } );
    
    $( "#message-box-stage .no" ).unbind( "click" );
    $( "#message-box-stage .no" ).bind( "click", 
        { "message-box" : this }, 
        function( ev ) {
            ev.data[ "message-box" ].hide();
            if ( on_no ) {
                on_no.call( this, data );
            }
        } );
    
};

MessageBox.prototype.show_error = function( title, message, on_ok, data ) {

    /*
    Show an error message box.
    */
    
    // Show the message
    this.show( $( "#error-message-box" ).html(), 
        title, 
        message 
        );

    // Bind the functions to button(s)
    $( "#message-box-stage .ok" ).unbind( "click" );
    
    $( "#message-box-stage .ok" ).bind( "click", 
        { "message-box" : this }, 
        function( ev ) {
            ev.data[ "message-box" ].hide();
            if ( on_ok ) {
                on_ok.call( this, data );
            }
        } );
};

MessageBox.prototype.show_information = function( title, message, on_ok, data ) {

    /*
    Show an information message box.
    */

    // Show the message
    this.show( $( "#information-message-box" ).html(), 
        title, 
        message 
        );

    // Bind the functions to button(s)
    $( "#message-box-stage .ok" ).unbind( "click" );
    $( "#message-box-stage .ok" ).bind( "click", 
        { "message-box" : this }, 
        function( ev ) {
            ev.data[ "message-box" ].hide();
            if ( on_ok ) {
                on_ok.call( this, data );
            }
        } );
};

MessageBox.prototype.show_warning = function( title, message, on_ok, data ) {

    /*
    Show a warning message box.
    */

    // Show the message
    this.show( $( "#warning-message-box" ).html(), 
        title, 
        message 
        );

    // Bind the functions to button(s)
    $( "#message-box-stage .ok" ).unbind( "click" );
    $( "#message-box-stage .ok" ).bind( "click", 
        { "message-box" : this }, 
        function( ev ) {
            ev.data[ "message-box" ].hide();
            if ( on_ok ) {
                on_ok.call( this, data );
            }
        } );
};