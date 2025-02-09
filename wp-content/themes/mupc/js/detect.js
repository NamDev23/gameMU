
    var app = (function (module) {
      var streamers;
      var showOnLoad;
      var domain;
      var showLiveLimit = 4;

      function initStreamClick() {
        $('.stream-hover').click(function (e) {
          e.preventDefault();

          window.open($(this).data('link'), '_blank');
        });
      };

      function initAlerterClick(streamers) {
        $('.alerter').click(function (e) {
          e.preventDefault();

          $('.streams').slideToggle();
          rotateArrow(showOnLoad = !showOnLoad);

          setTimeout(function () {
            if ($('.streams').is(':hidden')) { setCookie('hidestreambox', 1, 1000 * 3600 * 12); }
            if ($('.streams').is(':visible')) { setCookie('hidestreambox', 0, 0); }
          }, 1000);

        });
      };

      function isMobile() {
        return $(window).width() < 1000;
      };

      function getHideCookie() {
        return parseInt(getCookie('hidestreambox'));
      };

      function rotateArrow(showOnLoad) {
        if (showOnLoad) {
          if (!isMobile()) { showStreams(); }
          $('.alert-down').show(); $('.alert-up').hide();
        }
        else {
          $('.alert-down').hide(); $('.alert-up').show();
          if (!isMobile()) { hideStreams(); }
        }
      }

      function addStreamToBox(stream, show) {


        if (stream.platform == 'facebook') {
          show = 'stream';
        }

        var url, link;
        if (stream.platform == 'youtube') {
          //url = 'https://www.youtube.com/embed/live_stream?channel='+stream.identifier+'&controls=0&showinfo=0&autoplay=1&modestbranding=1&mute=1&rel=0&autohide=1&vq=small';
          // wtf fix 2021-11-16
          url = 'https://www.youtube.com/embed/' + stream.videoId + '?channel=' + stream.identifier + '&controls=0&showinfo=0&autoplay=1&modestbranding=1&mute=1&rel=0&autohide=1&vq=small';
          link = 'https://www.youtube.com/watch?v=' + stream.videoId;
        }
        else
          if (stream.platform == 'facebook') {
            link = 'https://www.facebook.com/' + stream.identifier + '/videos/' + stream.videoId;
            url = 'https://www.facebook.com/plugins/video.php?autoplay=false&allowfullscreen=false&showtext=false&showcaptions=false&href=' + link + '&width=224';
          }
          else {
            url = 'https://player.twitch.tv/?channel=' + stream.identifier + '&muted=true&controls=false&parent=' + domain;
            link = 'https://www.twitch.tv/' + stream.username;
          }

        var currentUrl = url;
        if (stream.thumbnail.length == 0) { stream.thumbnail = 'https://mu.bless.gs/gallery/big/c4154b6710fc9f8a2a41ffe0d0483660.jpg'; }
        if ((!isMobile() && getHideCookie() == 1) || show == 'thumb') {
          currentUrl = stream.thumbnail;
        }



        //var frame = !isMobile() || stream.platform == 'facebook' ? '<iframe  style="display:none;z-index:0" class="frame-video" width="224" height="126" src="'+currentUrl+'" frameborder="0" scrolling="no" allowfullscreen data-image="'+stream.thumbnail+'" data-video="'+url+'">' : '';

        var frame = '';
        if (!isMobile()) {
          var frame = '<iframe  style="display:none;z-index:0" class="frame-video" width="224" height="126" src="' + currentUrl + '" frameborder="0" scrolling="no" allowfullscreen data-image="' + stream.thumbnail + '" data-video="' + url + '">';
        }
        else {
          if (stream.platform == 'facebook')
            var frame = '<iframe  style="display:block;z-index:0" class="frame-video" width="224" height="126" src="' + currentUrl + '" frameborder="0" scrolling="no" allowfullscreen data-image="' + stream.thumbnail + '" data-video="' + url + '">';
        }


        if (show == 'thumb') { frame = ''; }

        let icon = '';
        let mic = '<img style="height:18px;vertical-align:sub" src="modules/smsshop/img/items/empty.png">';
        if (stream.mic == 1) mic = '<img style="height:18px;vertical-align:sub" src="img/mic-' + stream.mic + '.png">';


        // let icon = null;
        // if(stream.platform == 'twitch') {
        //   icon = '<img style="vertical-align:bottom" src="https://img.icons8.com/fluency/2x/twitch.png" width="15px">';
        // }
        // else {
        //   icon = '<img style="vertical-align:bottom" src="https://www.svgrepo.com/show/157839/youtube.svg" width="15px">';
        // }

        //'<div style="color:#EEE;position:relative;z-index:9999;font-size:14px;background-color:rgba(0, 0, 0, 1);right:0;width:224px;top:15px">'+stream.username+''+
        //background:url('+stream.thumbnail+') no-repeat;background-size: 224px 126px

        var frameImage = '';
        if (stream.platform == 'facebook') {
          //frameImage = '<img style="display:none;z-index:0" class="frame-image '+(show == 'thumb' ? 'frame-video' : '')+'" src="'+stream.thumbnail+'" width="224" height="126">';
        }
        else {
          frameImage = '<img style="z-index:0" class="frame-image ' + (show == 'thumb' ? 'frame-video' : '') + '" src="' + stream.thumbnail + '" width="224" height="126">';
        }

        $('.streams').prepend('' +
          '<div class="stream" style="padding-top:5px">' +

          '<div style="background-color:rgba(0, 0, 0, 1);color:#EEE;width:224px;height:20px;text-align:right"><span>' + stream.langLine + ' ' + mic + ' <span style="padding-right:3px">' + stream.username + '' +
          '<div class="stream-hover" title="' + stream.username + '" data-link="' + link + '" style="z-index:0;background:url(' + stream.thumbnail + ') no-repeat;background-size: 224px 126px">' +
          '' + frameImage + '' +
          '' + frame + '' +

          '');

        if (isMobile() || show == 'thumb') {
          if (stream.platform != 'facebook') { $('.frame-image').show() }
        }
      };
      function hideStreams() {
        $('.frame-video').hide();
        $('.frame-image').show();

        $('.frame-video').each(function () {
          $(this).attr('src', $(this).data('image'));
        });
      };
      function showStreams() {
        $('.frame-video').each(function () {
          $(this).attr('src', $(this).data('video'));
        });

        setTimeout(function () {
          $('.frame-image').hide();
          $('.frame-video').show();
        }, 500);

      };

      // '<div class="stream-bottom">'+stream.username+' <span class="live"><span class="dot">&nbsp;&nbsp;Live'+

      var me = {};

      me.init = function (settings) {
        streamers = settings.streamers;
        domain = settings.domain;

        if (streamers.length == 0) { return; }

        showOnLoad = getHideCookie() !== 1;
        rotateArrow(showOnLoad);
        if (!showOnLoad) { $('.streams').hide(); }

        for (var i = 0; i < streamers.length; i++) {
          var stream = streamers[i];

          var show = isMobile() || (i >= showLiveLimit && stream.platform != 'twitch') ? 'thumb' : 'stream';

          addStreamToBox(stream, show);
        }

        initAlerterClick();
        initStreamClick();

        $('.stream-box').fadeIn('slow'); // show streambox

        setTimeout(function () { $('.stream-hover').css('background', 'none'); }, 4 * 1000);
        //$('.alert-down').mouseover(function() { $(this).attr('src', 'img/streambox/close_light.png'); }).mouseout(function() { $(this).attr('src', 'img/streambox/close.png'); });
        $('.alert-down, .alert-up').mouseover(function () { $(this).attr('src', 'img/streambox/arrow_light.png'); }).mouseout(function () { $(this).attr('src', 'img/streambox/arrow.png'); });
      };

      module.streamBox = me;

      return module;

    }(app));
