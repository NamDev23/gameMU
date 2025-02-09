
    var app = (function () {
      // var privateVariable = 1;
      // function privateMethod() {}

      var me = {};

      // me.publicProperty = 1;
      // me.publicMethod = function () {};

      me.scrollTop = function (selector) {
        if (selector === undefined) {
          selector = '.content';
        }

        $('html, body').animate({ scrollTop: $(selector).offset().top }, 'slow');
      };

      me.htmlDecode = function (text) {
        return $('<div/>').html(text).text();
      };

      me.msgClear = function () {
        $('.warning-summary').remove();
        $('.error').remove();
      };
      me.msg = function (msg, success = false) {
        me.msgClear();
        $('.content').prepend('<div class="warning-summary ' + (success ? 'msg-success' : '') + '">' + msg + '');
      };

      me.blockUI = function () {
        $.blockUI({ message: null, overlayCSS: { backgroundColor: 'none' }, baseZ: 2000 });

        //setTimeout(function() { $.unblockUI(); console.error('UI unblocked by timeout'); }, 1000 * 10);
      };
      me.unblockUI = function () {
        $.unblockUI();
      };

      me.textToClipboard = function (text) {
        var $temp = $("<textarea>");
        $("body").append($temp);
        $temp.val(text).select();
        document.execCommand("copy");
        $temp.remove();
      };
      me.itemInfoToClipboard = function () {
        var text = '';
        $('#tooltip').first('h3').first('table').find('td').each(function () {
          text = text.concat($(this).text() + "\n");
        });

        me.textToClipboard(text);
      };

      me.display_leadZero = function (val) {
        return val < 10 ? '0' + val : val;
      },
        me.display_timer_init = function (timestart) {
          return new Date(timestart).getTime(); // unix seconds, hz kak tam s timezonoj
        },
        me.display_timer_tick = function (countDownDate, timer) {
          var date = new Date(new Date().toLocaleString('en-US', { timeZone: 'Europe/Riga' })).getTime();
          var distance = countDownDate - date;
          if (distance < 0) { distance = 0; }

          var days = me.display_leadZero(Math.floor(distance / (1000 * 60 * 60 * 24)));
          var hours = me.display_leadZero(Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)));
          var minutes = me.display_leadZero(Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)));
          var seconds = me.display_leadZero(Math.floor((distance % (1000 * 60)) / 1000));

          //timer.display = timer.format.replace("{DD}", days).replace("{HH}", hours).replace("{mm}", minutes).replace("{ss}", seconds);
          timer.display = days + ':' + hours + ':' + minutes + ':' + seconds;

          return distance != 0;
        },


        me.init = function (settings) {
        };

      return me;
    })();
