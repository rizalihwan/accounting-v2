! function(e, s, i) {
    "use strict";
    document.addEventListener('click', function(event) {
        var $rightSidebar = document.getElementsByClassName('right-sidebar')[0],
            $chatPanel = document.getElementsByClassName('chat-panel')[0];
        var isInsideContainer = $rightSidebar.contains( event.target ) || $chatPanel.contains(event.target);
        if( !isInsideContainer ) {
          document.body.classList.remove('right-sidebar-expand');
          var toggle = document.getElementsByClassName('right-sidebar-toggle');
          for( var i = 0; i < toggle.length; i++ ) {
            toggle[i].classList.remove('active');
          }
          $chatPanel.hidden = 'hidden';
        }
    });

    var el = $('[data-plugin="chat-sidebar"]');
    if( !el.length ) return;
    var chatList = el.find('.chat-list');
    chatList.each(function(index) {
        var $this = $(this);
        $(this).find('.list-group a').on('click', function() {
            $this.find('.list-group a.active').removeClass('active');
            $(this).addClass('active');
            var el = $('.chat-panel');
            if(!el.length) return;
            el.removeAttr('hidden');

            var messages = el.find('.messages');
            messages[0].scrollTop = messages[0].scrollHeight;
            if( messages[0].classList.contains('scrollbar-enabled') ) {
                messages.perfectScrollbar('update');
            }
            el.find('.user-name').html( $(this).data('chat-user'));
        });
    });

    var el = $('.chat-panel');
    if(!el.length) return;
    el.find('.close').on('click', function(){
        el.attr('hidden', true);
        el.find('.panel-body').removeClass('hide');
    });

    el.find('.minimize').on('click', function(){
        el.find('.card-block').attr('hidden', !el.find('.card-block').attr('hidden') );
        if( el.find('.card-block').attr('hidden') === 'hidden' )
            $(this).find('.material-icons').html('expand_less');
        else
        $(this).find('.material-icons').html('expand_more');
    });
}(window, document, jQuery);